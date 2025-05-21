<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Por favor ingresa el código de verificación que hemos enviado a tu correo.') }}
    </div>

    @if (session('error'))
        <div class="mb-4 text-red-600">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('verificar.codigo') }}">
        @csrf

        <div>
            <x-input-label for="codigo" :value="__('Código de Verificación')" />
            <x-text-input id="codigo" class="block mt-1 w-full" type="text" name="codigo" required autofocus />
        </div>

        <div class="mt-4">
            <x-primary-button>
                {{ __('Verificar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
