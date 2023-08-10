<x-action-section>
    <x-slot name="title">
        {{ __('Two Factor Authentication') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Add additional security to your account using two factor authentication.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900">
            @if ($this->enabled)
                @if ($showingConfirmation)
                    {{ __('Termine de habilitar la autenticación de dos factores.') }}
                @else
                    {{ __('Ha habilitado la autenticación de dos factores.') }}
                @endif
            @else
                {{ __('No ha habilitado la autenticación de dos factores.') }}
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600">
            <p>
                {{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}
            </p>
        </div>

        
        

        @if ($this->enabled)
            @if ($showingQrCode)
            <div class="mt-3 max-w-xl text-sm text-gray-600">
                <h3 class="text-lg font-medium text-gray-900">
                    {{ __('Paso 1: Instale el Autenticador de Microsoft') }}
                </h3>
                <p>
                    {{ __('Descargue e instale Microsoft Authenticator en:')}}
                </p>
                <div style="display: flex;">
                    <div style="display: flex; align-items: center; flex-direction: column;">
                        <img src="https://chart.googleapis.com/chart?cht=qr&chl=https%3A%2F%2Fplay.google.com%2Fstore%2Fapps%2Fdetails%3Fid%3Dcom.azure.authenticator&chs=180x180&choe=UTF-8&chld=L|2" alt="qr code"><a href="www.qr-code-generator.com/" border="0" style="cursor:default" rel="nofollow"></a>
                        <p>
                            Google play
                        </p>
                    </div>
                    <div style="display: flex; align-items: center; flex-direction: column;">
                        <a href="www.qr-code-generator.com/" border="0" style="cursor:default" rel="nofollow"><img src="https://chart.googleapis.com/chart?cht=qr&chl=https%3A%2F%2Fapps.apple.com%2Fus%2Fapp%2Fmicrosoft-authenticator%2Fid983156458&chs=180x180&choe=UTF-8&chld=L|2"></a>
                        <p>
                            App store
                        </p>
                    </div>
                </div>
                <h3 class="text-lg font-medium text-gray-900">
                    {{ __('Paso 2: Vincula tu dispositivo a tu cuenta') }}
                </h3>
                <p>
                    {{ __('Tienes dos opciones para vincular tu dispositivo a tu cuenta:')}}
                </p>
                <br>
                <p>
                    {{ __('Usando el código QR: SeleccionarEscanear un código de barras . Si la aplicación Authenticator no puede encontrar una aplicación de escáner de código de barras en su dispositivo móvil, es posible que se le solicite que descargue e instale una. Si desea instalar una aplicación de escáner de código de barras para poder completar el proceso de configuración, seleccione Instalar y luego realice el proceso de instalación. Una vez que la aplicación esté instalada, vuelva a abrir Microsoft Authenticator, luego apunte su cámara al código QR en la pantalla de su computadora.')}}
                </p>
                <br>
                <p>
                    {{ __('Usando la clave secreta: Seleccionar Introduce la clave proporcionada, luego ingrese el nombre de la cuenta de su cuenta en el Ingrese el nombre de la cuenta caja. Luego, ingrese la clave secreta que aparece en la pantalla de su computadora en el Introduzca su clave caja. Asegúrese de haber elegido hacer que la clave se base en el tiempo, luego seleccione Agregar.')}}
                </p>


            </div>
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        @if ($showingConfirmation)
                            {{ __('Para terminar de habilitar la autenticación de dos factores, escanee el siguiente código QR usando la aplicación de autenticación de su teléfono o ingrese la clave de configuración y proporcione el código OTP generado.') }}
                        @else
                            {{ __('La autenticación de dos factores ahora está habilitada. Escanee el siguiente código QR usando la aplicación de autenticación de su teléfono o ingrese la clave de configuración.') }}
                        @endif
                    </p>
                </div>

                <div class="mt-4 p-2 inline-block bg-white">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>

                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ __('Setup Key') }}: {{ decrypt($this->user->two_factor_secret) }}
                    </p>
                </div>

                @if ($showingConfirmation)
                    <div class="mt-4">
                        <x-label for="code" value="{{ __('Code') }}" />

                        <x-input id="code" type="text" name="code" class="block mt-1 w-1/2" inputmode="numeric" autofocus autocomplete="one-time-code"
                            wire:model.defer="code"
                            wire:keydown.enter="confirmTwoFactorAuthentication" />

                        <x-input-error for="code" class="mt-2" />
                    </div>
                @endif
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-5">
            @if (! $this->enabled)
                <x-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-button type="button" wire:loading.attr="disabled">
                        {{ __('Enable') }}
                    </x-button>
                </x-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-secondary-button class="mr-3">
                            {{ __('Regenerate Recovery Codes') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @elseif ($showingConfirmation)
                    <x-confirms-password wire:then="confirmTwoFactorAuthentication">
                        <x-button type="button" class="mr-3" wire:loading.attr="disabled">
                            {{ __('Confirm') }}
                        </x-button>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="showRecoveryCodes">
                        <x-secondary-button class="mr-3">
                            {{ __('Show Recovery Codes') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @endif

                @if ($showingConfirmation)
                    <x-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-secondary-button wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-danger-button wire:loading.attr="disabled">
                            {{ __('Disable') }}
                        </x-danger-button>
                    </x-confirms-password>
                @endif

            @endif
        </div>
    </x-slot>
</x-action-section>
