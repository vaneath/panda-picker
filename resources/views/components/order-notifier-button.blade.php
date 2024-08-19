<button onclick="notifyCustomer({{ $order->id }})"
    class="bg-pink-500 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded">
    Notify
</button>


<script>
    function notifyCustomer(orderId) {
        fetch(`/orders/${orderId}/notify`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Notification Sent!',
                        text: 'The customer has been notified',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#fa2a80'
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to send notification',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while sending the notification',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
    }
</script>
