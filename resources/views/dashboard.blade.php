<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- component -->
    <div class="bg-white overflow-hidden w-full grid place-items-center">
        <div class="w-full sm:w-4/5 px-4 sm:px-0">
            <form method="GET" action="{{ route('dashboard') }}" class="mb-4" id="filterForm">
                <div class="flex flex-col space-y-3 sm:space-y-0 sm:space-x-3 sm:flex-row">
                    <x-text-input id="order_date" class="form-input shrink w-full sm:w-auto" type="date" name="order_date"
                        placeholder="order_date..." value="{{ request('order_date', now()->toDateString()) }}" />

                    <select name="order_status"
                        class="form-select w-full sm:w-auto bg-white border h-10 border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded-md leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="">All Statuses</option>
                        @foreach (\App\Enums\OrderStatusEnum::cases() as $status)
                            <option value="{{ $status->value }}"
                                {{ request('order_status') === $status->value ? 'selected' : '' }}>
                                {{ $status->value }}
                            </option>
                        @endforeach
                    </select>

                    <select name="sort_order"
                        class="form-select w-full sm:w-auto bg-white border h-10 border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded-md leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                        <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Descending</option>
                    </select>
                </div>

                <div class="flex flex-col sm:flex-row sm:space-x-3 mt-4 space-y-3 sm:space-y-0">
                    <x-text-input id="search" class="form-input shrink w-full sm:w-auto" type="text" name="search"
                        placeholder="Search..." value="{{ request('search') }}" />

                    <x-primary-button class="w-full sm:w-40 justify-center">Filter</x-primary-button>
                </div>
            </form>
        </div>
        <x-order-table />
    </div>

    <script>
        document.getElementById('filterForm').addEventListener('submit', function() {
            const orderDateInput = document.getElementById('order_date');
            if (!orderDateInput.value) {
                orderDateInput.value = new Date().toISOString().split('T')[0];
            }
        });
    </script>
</x-app-layout>
