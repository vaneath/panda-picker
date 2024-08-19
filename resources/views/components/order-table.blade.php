<div class="overflow-x-auto p-6">
    <table class="table-auto w-full ">
        <thead class="text-md font-semibold uppercase text-gray-400 bg-gray-50">
            <tr>
                <th class="p-2 whitespace-nowrap">
                    <div class="font-semibold text-center">Id</div>
                </th>
                <th class="p-2 whitespace-nowrap">
                    <div class="font-semibold text-center">Order Number</div>
                </th>
                <th class="p-2 whitespace-nowrap">
                    <div class="font-semibold text-center">Name</div>
                </th>
                <th class="p-2 whitespace-nowrap">
                    <div class="font-semibold text-center">Floor</div>
                </th>
                <th class="p-2 whitespace-nowrap">
                    <div class="font-semibold text-center">Phone Number</div>
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
                <tr>
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
                        <div class="text-center font-medium text-green-500">{{ $order->floor }}</div>
                    </td>
                    <td class="p-2 whitespace-nowrap">
                        <div class="text-lg text-center">{{ $order->customer_phone_number }}</div>
                    </td>
                    <td class="p-2 whitespace-nowrap">
                        <div class="text-lg text-center">{{ $order->order_summary }}</div>
                    </td>
                    <td class="p-2 whitespace-nowrap">
                        <x-order-status-dropdown :order="$order" />
                        {{-- <div x-data="{ status: '{{ $order->order_status }}' }" class="text-center">
                            <select x-model="status" @change="updateStatus('{{ $order->id }}', status)"
                                class="form-select">
                                @foreach (\App\Enums\OrderStatusEnum::cases() as $status)
                                    <option value="{{ $status->value }}"
                                        :selected="$order -> order_status === '{{ $status->value }}'">
                                        {{ $status->value }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                    </td>
                    <td class="p-2 whitespace-nowrap">
                        <div class="text-center">
                            <button
                                onclick="Swal.fire({ title: 'Notification Sent!', text: 'The customer has been notified', icon: 'success', confirmButtonText: 'OK' })"
                                class="bg-pink-500 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded">
                                Notify
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $orders->links() }}
</div>
