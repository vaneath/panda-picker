<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- component -->
    <div class="w-full mx-auto bg-white rounded-sm border-t border-gray-200 p-8">
        <x-order-table />
    </div>
</x-app-layout>
