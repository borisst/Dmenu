<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}

        </h2>
    </x-slot>
    @auth()
        <x-sidebar>

        </x-sidebar>
    @endauth

</x-app-layout>
