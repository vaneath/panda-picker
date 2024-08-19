<div class="overflow-x-auto space-y-24">
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
                    <td class="p-2 whitespace-nowrap">
                        <div class="text-lg text-center">{{ $order->order_summary }}</div>
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
