<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-300 leading-tight">
            {{ __('Дашборд') }}
        </h2>
    </x-slot>

    <!-- Основной контент -->
    <div> 
        @include('photo-page')
    </div>

</x-app-layout>

