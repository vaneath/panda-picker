<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- component -->
    <section class="antialiased bg-gray-100 text-gray-600 h-screen mt-6 ">
        <div class="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200 p-8">
            <x-order-table />
        </div>
    </section>
</x-app-layout>
