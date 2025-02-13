@extends('layouts.full')
@section('content')
   <div class="header index-bg pb-5">
      <div class="container-fluid">
         <div class="header-body-nb">
            <div class="row align-items-end">
               <div class="col">
                  <h6 class="header-pretitle text-secondary-light">
                     {{utrans("headers.summary")}}
                  </h6>
                  <h1 class="header-title text-white">
                     {{utrans("headers.wifi")}}
                  </h1>
               </div>
            </div>
         </div>

         <div class="header-footer">
         </div>
      </div>
   </div>
   <div class="container-fluid mt--6">
      <div class="row">
         @foreach($networks as $network)
         <div class="col-12 col-xl-4">
            <x-wifi-card :network="$network" />
         </div>
         @endforeach
      </div>
   </div>
@endsection