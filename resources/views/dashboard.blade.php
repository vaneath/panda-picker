<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- component -->
    <section class="antialiased bg-gray-100 text-gray-600 h-screen mt-6 ">
        <div class="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200 p-8">
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
                                    // dropdown
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $orders->links() }}
            </div>
        </div>
    </section>
</x-app-layout>
