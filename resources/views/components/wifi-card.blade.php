@props(['network'])
@php
    $enableSwitchInputName = "enableSwitch" . $network['uuid'];
@endphp
<script nonce="{{ csp_nonce() }}">
    document.addEventListener('DOMContentLoaded', function () {
        const checkbox = document.getElementById("{{ $enableSwitchInputName }}");
        if (checkbox) {
            checkbox.addEventListener('click', function () {
                this.closest('form').submit();
            });
        }
    });
</script>
<div class="card">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="card-title text-uppercase text-muted mb-2">
                    {{ utrans('network.wifi.network', ['type' => utrans("network.wifi.type-{$network['type']}")]) }}
                </h6>
            </div>
            <div class="col-auto">
                <span class="h2 fe fe-wifi mb-0 {{ $network['online'] ? 'text-success' : 'text-secondary' }}"></span>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col text-center">
                @if($network['enabled'])

                <div class="d-flex justify-content-center align-items-center mt-2" style="font-size: 1.25rem">
                    <div class="mr-2 text-secondary">
                        {{ utrans('network.wifi.SSID') }}:
                    </div>
                    <div class="mr-3" id="ssid-{{ $network['uuid'] }}">
                        {{ $network['ssid'] }}
                    </div>
                    <div>
                        <i class="h2 fe fe-copy mb-0 text-primary" data-copy="{{ $network['ssid'] }}"
                           style="cursor: pointer;" data-toggle="tooltip" title="{{utrans('network.wifi.copy', ['field' => trans('network.wifi.SSID')])}}"></i>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center mt-2" style="font-size: 1.25rem">
                    <div class="mr-2 text-secondary">
                        {{ utrans('network.wifi.password') }}:
                    </div>
                    <div class="mr-3">
                        {{ $network['password'] }}
                    </div>
                    <div>
                        <i class="h2 fe fe-copy mb-0 text-primary" data-copy="{{ $network['password'] }}"
                           style="cursor: pointer;" data-toggle="tooltip" title="{{utrans('network.wifi.copy', ['field' => trans('network.wifi.password')])}}"></i>
                    </div>
                </div>
                <div class="my-5">
                    <img src="data:image/png;base64,{{ base64_encode(
                        SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')
                            ->size(225)
                            ->generate('WIFI:T:WPA;S:' . $network['ssid'] . ';P:' . $network['password'] . ';;')
                    ) }}" alt="WiFi QR Code">
                </div>
                <div class="text-secondary d-flex justify-content-center align-items-center">
                    <span class="h2 fe fe-camera mb-0 mr-2"></span>
                    <span>{{ utrans('network.wifi.scanQrCodeMessage') }}</span>
                </div>

                @endif
                <div class="mt-4 row align-items-center">
                    @if($network['type'] === 'guest')
                        <div class="col d-flex justify-content-center align-items-center">
                            {!! Form::open(['url' => route('network.update', ['uuid' => $network['uuid']])]) !!}
                            <input type="hidden" name="enabled" value="{{ $network['enabled'] ? 0 : 1 }}">
                            <div class="custom-control custom-checkbox-toggle mt-1">
                                <input type="checkbox"
                                       id="{{$enableSwitchInputName}}"
                                       name="{{$enableSwitchInputName}}"
                                        {{ $network['enabled'] ? 'checked' : '' }}
                                        {{ $attributes->merge(['class' => 'custom-control-input']) }}>
                                <label class="custom-control-label" for="{{$enableSwitchInputName}}"></label>
                            </div>
                            {!! Form::close() !!}
                            <label for="{{$enableSwitchInputName}}" class="ml-3 mb-0 text-secondary">
                                {{ $network['enabled'] ? utrans('network.wifi.enabled') : utrans('network.wifi.disabled') }}
                            </label>
                        </div>
                    @endif

                    <div class="col d-flex justify-content-center">
                        <button class="btn btn-outline-secondary">
                            {{ utrans('network.wifi.updateDetailsButton') }}
                        </button>
                    </div>
                </div>
                @if($network['enabled'])
                    <div class="mt-5" >
                        <a class="btn btn-lg btn-outline-primary" href="#" role="button">
                            {{ utrans('network.wifi.shareConnectionButton') }}<span class="fe fe-send"></span>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>