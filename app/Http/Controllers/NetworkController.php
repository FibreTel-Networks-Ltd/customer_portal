<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NetworkController extends Controller
{
    public function wifi()
    {
        $defaultNetworks = [
            [
                'uuid' => 'abc',
                'ssid' => 'FibreTel B77UD',
                'online' => true,
                'password' => 'pItch2#1',
                'type' => 'ordinary',
                'enabled' => true,
            ],
            [
                'uuid' => 'def',
                'ssid' => 'FibreTel B77UD - Guest',
                'online' => false,
                'password' => 'purchAserS8',
                'type' => 'guest',
                'enabled' => false,
            ]
        ];

        if(!session()->has('networks')) {
            session(['networks' => $defaultNetworks]);
        }



        return view('pages.network.wifi', ['networks' => session('networks')]);
    }

    public function updateNetwork(Request $request, $uuid)
    {
        $networks = session('networks');

        foreach ($networks as &$network) {
            if ($network['uuid'] === $uuid) {
                $network['password'] = $request->input('password', $network['password']);
                $network['enabled'] = $request->input('enabled', $network['enabled']);
                $network['online'] = $network['enabled'];
            }
        }


        session(['networks' => $networks]);

        $message = match ( $request->input('enabled') ) {
            '1' => 'networkEnabled',
            '0' => 'networkDisabled',
            default => 'networkUpdated'
        };

        return redirect()->back()->with('success', utrans('network.wifi.'.$message));
    }
}