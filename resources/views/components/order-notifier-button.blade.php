<button id="notifyButton" onclick="notifyCustomer({{ $order->id }})"
    class="bg-pink-500 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded">
    <div class="flex items-center justify-center space-x-2">
        <svg id="spinner" class="hidden animate-spin" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
            viewBox="0 0 24 24">
            <path fill="currentColor"
                d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z">
                <animateTransform attributeName="transform" dur="0.75s" repeatCount="indefinite" type="rotate"
                    values="0 12 12;360 12 12" />
            </path>
        </svg>
        <span id="buttonText">Notify</span>
    </div>
</button>

<script>
    function notifyCustomer(orderId) {
        const button = document.getElementById('notifyButton');
        const spinner = document.getElementById('spinner');
        const buttonText = document.getElementById('buttonText');

        console.log('Notifying customer...');

        button.disabled = true;
        spinner.classList.remove('hidden');

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
            })
            .finally(() => {
                button.disabled = false;
                spinner.classList.add('hidden');
                buttonText.textContent = 'Notify';
            });
    }
</script>
