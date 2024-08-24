<div class="w-full min-h-screen space-y-5 overflow-x-scroll mb-10">
    <table class="table-auto w-full mb-6 hidden sm:inline-table">
        <thead class="text-md font-semibold uppercase text-gray-400 bg-gray-50">
            <tr>
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
                    <td class="p-2 whitespace-nowrap text-center">
                        <x-order-status-dropdown :order="$order" />
                    </td>
                    <td class="p-2 whitespace-nowrap text-center">
                        <x-order-notifier-button :order="$order" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="table-auto w-full mb-6 sm:hidden">
        <thead class="text-md font-semibold uppercase text-gray-400 bg-gray-50">
            <tr>
                <th class="p-2 whitespace-nowrap">
                    <div class="font-semibold text-center">Order</div>
                </th>
                <th class="p-2 whitespace-nowrap">
                    <div class="font-semibold text-center">Order Summary</div>
                </th>
                <th class="p-2 whitespace-nowrap">
                    <div class="font-semibold text-center">Notify Customer</div>
                </th>
            </tr>
        </thead>
        <tbody class="text-md divide-y divide-gray-100">
            @foreach ($orders as $order)
                <tr class="hover:bg-gray-100 active:bg-gray-100">
                    <td class="p-2 whitespace-nowrap text-center">
                        <div class="font-bold text-gray-800 ">{{ $order->order_number }}</div>
                        <div class="">{{ $order->customer_name }}</div>
                        <div class="text-lg ">{{ $order->customer_phone_number }}</div>
                        <div class=" font-medium text-green-500">{{ $order->floor }}</div>
                    </td>
                    <td class="p-2 whitespace-nowrap">
                        @if ($order->order_summary)
                            <div class="flex justify-center">
                                <a href="{{ Storage::url($order->order_summary) }}" target="_blank">
                                    <img class="size-24 object-contain block"
                                        src="{{ Storage::url($order->order_summary) }}" alt="Order Summary Image">
                                </a>
                            </div>
                        @else
                            <div class="text-lg mt-1 text-center">No image available</div>
                        @endif
                    </td>
                    <td class="p-2 whitespace-nowrap text-end space-y-3">
                        <x-order-status-dropdown :order="$order" />
                        <x-order-notifier-button :order="$order" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $orders->links() }}
</div>
