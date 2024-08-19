<x-guest-layout>
    <div class="py-5">
        <div class="relative py-3 max-w-3xl mx-auto">
            <div
                class="absolute inset-0 bg-gradient-to-r from-pink-400 to-pink-500 shadow-lg transform -skew-y-0 -rotate-6 rounded-3xl">
            </div>
            <div class="relative px-10 py-10 bg-white shadow-lg rounded-3xl">
                <div class="max-w-lg mx-auto">
                    <div>
                        <h1 class="text-2xl font-semibold">Foodpanda Picker Form</h1>
                    </div>
                    <div class="divide-y divide-gray-200">
                        <div class="py-8 space-y-4 text-gray-700 text-lg leading-7">
                            <form method="POST" action="{{ route('orders.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mt-4">
                                    <div class="flex space-x-1">
                                        <x-input-label for="order-number" :value="__('Order Number')" />
                                        <span class="text-red-600">*</span>
                                    </div>
                                    <x-text-input id="order-number" class="block mt-1 w-full" type="text"
                                        name="order_number" required autocomplete="current-order-number"
                                        placeholder="#xxxx-xxxx-xxxx" />
                                    <x-input-error :messages="$errors->get('order_number')" class="mt-2" />
                                </div>

                                <div class="mt-4">
                                    <div class="flex space-x-1">
                                        <x-input-label for="customer-name" :value="__('Your Name')" />
                                        <span class="text-red-600">*</span>
                                    </div>
                                    <x-text-input id="customer-name" class="block mt-1 w-full" type="text"
                                        name="customer_name" required autocomplete="current-customer-name" />
                                    <x-input-error :messages="$errors->get('customer_name')" class="mt-2" />
                                </div>

                                <div class="mt-4">
                                    <div class="flex space-x-1">
                                        <x-input-label for="customer-phone-number" :value="__('Phone Number')" />
                                        <span class="text-red-600">*</span>
                                    </div>
                                    <x-text-input id="customer-phone-number" class="block mt-1 w-full" type="number"
                                        name="customer_phone_number" required
                                        autocomplete="current-customer-phone-number" placeholder="0xx xxx xxx" />
                                    <x-input-error :messages="$errors->get('customer_phone_number')" class="mt-2" />
                                </div>

                                <div class="mt-4">
                                    <div class="flex space-x-1">
                                        <x-input-label for="floor" :value="__('Floor')" />
                                        <span class="text-red-600">*</span>
                                    </div>
                                    <x-text-input id="floor" class="block mt-1 w-full" type="number" name="floor"
                                        required autocomplete="current-floor" min="1" max="50" />
                                    <x-input-error :messages="$errors->get('floor')" class="mt-2" />
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="order-summary" :value="__('Order Summary (This is optional but deliver your order faster)')" />
                                    <div id="file-upload"
                                        class="pt-5 pb-6 mt-1 flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                class="font-semibold">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                            800x400px)</p>
                                    </div>
                                    <input id="order-summary" name="order_summary" type="file" class="hidden" />
                                    <img id="image-preview" class="w-full h-full object-contain hidden" />
                                </div>

                                <input type="hidden" name="customer_chat_id"
                                    value="{{ request()->query('chat-id') }}" />

                                <div class="mt-4 text-end">
                                    <x-primary-button class="ml-4">
                                        {{ __('Submit') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <script>
            console.log('success');
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#fa2a80'
            });
        </script>
    @endif
</x-guest-layout>

<script>
    document.getElementById('file-upload').addEventListener('click', function() {
        document.getElementById('order-summary').click();
    });

    document.getElementById('order-summary').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const maxSize = 2048 * 1024; // 2 MB in bytes

        if (file) {
            if (file.size > maxSize) {
                Swal.fire({
                    title: 'Error!',
                    text: 'The file size exceeds the  MB limit.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#fa2a80'
                });
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const fileUploadDiv = document.getElementById('file-upload');
                fileUploadDiv.innerHTML = ''; // Clear the content inside the file-upload div
                const img = document.createElement('img');
                img.id = 'image-preview';
                img.src = e.target.result;
                img.classList.add('w-full', 'h-full', 'object-contain');
                fileUploadDiv.appendChild(img); // Append the image to the file-upload div
            };
            reader.readAsDataURL(file);
        }
    });
</script>
