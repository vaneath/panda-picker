<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- component -->
    <div class="bg-white overflow-hidden w-full grid place-items-center">
        <div class="w-4/5">
            <form method="GET" action="{{ route('dashboard') }}" class="mb-4">
                <div class="flex flex-col space-y-3 sm:space-x-3 sm:block">
                    <select name="order_status"
                        class="form-select bg-white border h-10 border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded-md leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="">All Statuses</option>
                        @foreach (\App\Enums\OrderStatusEnum::cases() as $status)
                            <option value="{{ $status->value }}"
                                {{ request('order_status') === $status->value ? 'selected' : '' }}>
                                {{ $status->value }}
                            </option>
                        @endforeach
                    </select>

                    <x-text-input id="search" class="form-input shrink" type="text" name="search"
                        placeholder="Search..." value="{{ request('search') }}" />
                    <x-primary-button class="w-40 justify-center self-end">Filter</x-primary-button>
                </div>
            </form>

            <form method="GET" action="{{ url()->current() }}">
                <div class="flex space-x-3 items-center mb-10">
                    <x-input-label for="sort_order" :value="__('Sort by Created At: ')" class="text-center" />
                    <select name="sort_order" onchange="this.form.submit()"
                        class="form-select bg-white border h-10 border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded-md leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                        <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Descending
                        </option>
                    </select>
                    <input type="hidden" name="order_status" value="{{ request('order_status') }}">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                </div>
            </form>
        </div>
        <x-order-table />
    </div>
</x-app-layout>
