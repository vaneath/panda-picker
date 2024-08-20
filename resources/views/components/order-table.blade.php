<div class="overflow-x-auto space-y-10">
    <div>
        <form method="GET" action="{{ route('dashboard') }}" class="mb-4">
            <div class="flex space-x-4">
                <div>
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
                </div>
                <div>
                    <x-text-input id="search" class="form-input" type="text" name="search" placeholder="Search..."
                        value="{{ request('search') }}" />
                </div>
                <div>
                    <x-primary-button>Filter</x-primary-button>
                </div>
            </div>
        </form>

        <form method="GET" action="{{ url()->current() }}">
            <div class="flex space-x-3 items-center">
                <x-input-label for="sort_order" :value="__('Sort by Created At: ')" class="text-center" />
                <select name="sort_order" onchange="this.form.submit()"
                    class="form-select bg-white border h-10 border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded-md leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                    <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Descending</option>
                </select>
                <input type="hidden" name="order_status" value="{{ request('order_status') }}">
                <input type="hidden" name="search" value="{{ request('search') }}">
            </div>
        </form>
    </div>


    <table class="table-auto w-full mb-6">
        <thead class="text-md font-semibold uppercase text-gray-400 bg-gray-50">
            <tr>
                <th class="p-2 whitespace-nowrap">
                    <div class="font-semibold text-center">Id</div>
                </th>
                <th class="p-2 whitespace-nowrap">
                    <div class="font-semibold text-center">Order Number</div>
                </th>
                <th class="p-2 whitespace-nowrap">
                    <div class="font-semibold text-center">Customer Name</div>
                </th>
                <th class="p-2 whitespace-nowrap">
                    <div class="font-semibold text-center">Phone Number</div>
                </th>
                <th class="p-2 whitespace-nowrap">
                    <div class="font-semibold text-center">Floor</div>
                </th>
                <th class="p-2 whitespace-nowrap">
                    <div class="font-semibold text-center">Order Summary</div>
                </th>
                <th class="p-2 whitespace-nowrap">
                    <div class="font-semibold text-center">Created At</div>
                </th>
                <th class="p-2 whitespace-nowrap">
                    <div class="font-semibold text-center">Order Status</div>
                </th>
                <th class="p-2 whitespace-nowrap">
                    <div class="font-semibold text-center">Notify Customer</div>
                </th>
            </tr>
        </thead>
        <tbody class="text-md divide-y divide-gray-100">
            @foreach ($orders as $order)
                <tr class="hover:bg-gray-100 active:bg-gray-100">
                    <td class="p-2 whitespace-nowrap">
                        <div class="font-medium text-gray-800 text-center">{{ $order->id }}</div>
                    </td>
                    <td class="p-2 whitespace-nowrap">
                        <div class="font-medium text-gray-800 text-center">{{ $order->order_number }}</div>
                    </td>
                    <td class="p-2 whitespace-nowrap">
                        <div class="text-center">{{ $order->customer_name }}</div>
                    </td>
                    <td class="p-2 whitespace-nowrap">
                        <div class="text-lg text-center">{{ $order->customer_phone_number }}</div>
                    </td>
                    <td class="p-2 whitespace-nowrap">
                        <div class="text-center font-medium text-green-500">{{ $order->floor }}</div>
                    </td>
                    <td class="p-2 whitespace-nowrap flex justify-center items-center">
                        @if ($order->order_summary)
                            <a href="{{ Storage::url($order->order_summary) }}" target="_blank">
                                <img class="size-24 object-contain" src="{{ Storage::url($order->order_summary) }}"
                                    alt="Order Summary Image">
                            </a>
                        @else
                            <div class="text-lg text-end mt-1">No image available</div>
                        @endif
                    </td>
                    <td class="p-2 whitespace-nowrap">
                        <div class="text-lg text-center">{{ $order->created_at }}</div>
                    </td>
                    <td class="p-2 whitespace-nowrap">
                        <x-order-status-dropdown :order="$order" />
                    </td>
                    <td class="p-2 whitespace-nowrap">
                        <div class="text-center">
                            <x-order-notifier-button :order="$order" />
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $orders->links() }}
</div>
