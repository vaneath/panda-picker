@props(['order'])

<!-- resources/views/components/order-status-dropdown.blade.php -->
<div x-data="{
    status: '{{ $order->order_status }}',
    getStatusClass() {
        return this.status === 'done' ? 'bg-green-500 text-white' : (this.status === 'preparing' ? 'bg-yellow-500 text-white' : 'bg-gray-500 text-white');
    }
}">
    <select x-model="status" @change="updateStatus('{{ $order->id }}', status)" :class="getStatusClass()"
        class="form-select border border-gray-300 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:border-gray-500">
        @foreach (\App\Enums\OrderStatusEnum::cases() as $status)
            <option value="{{ $status->value }}" {{ $order->order_status === $status->value ? 'selected' : '' }}>
                {{ ucfirst($status->value) }}
            </option>
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
            });
    }
</script>
