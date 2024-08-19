@props(['order_status'])

<!-- resources/views/components/order-status-dropdown.blade.php -->
<div x-data="{ status: '{{ $order->order_status }}' }" class="text-center">
    <select x-model="status" @change="updateStatus('{{ $order->id }}', status)"
        class="form-select bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
        @foreach (\App\Enums\OrderStatusEnum::cases() as $status)
            <option value="{{ $status->value }}" :selected="$order -> order_status === '{{ $status->value }}'">
                {{ $status->value }}</option>
        @endforeach
    </select>
</div>

<script>
    function updateStatus(orderId, status) {
        fetch(`/orders/${orderId}/status`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    status: status
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Order status updated successfully',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        confirmButtonColor: "#fa2a80",
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to update order status',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while updating the order status',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
    }
</script>
