<x-guest-layout>
    <div class="py-5" x-data="formHandler()">
        <div class="relative py-3 max-w-3xl mx-auto">
            <div
                class="absolute inset-0 bg-gradient-to-r from-pink-400 to-pink-500 shadow-lg transform -skew-y-0 -rotate-6 rounded-3xl">
            </div>
            <div class="relative px-10 py-10 bg-white shadow-lg rounded-3xl">
                <div class="max-w-lg mx-auto">
                    <div>
                        <h1 class="text-2xl font-semibold">Panda ToanChet Form</h1>
                    </div>
                    <div class="divide-y divide-gray-200">
                        <div class="py-8 space-y-4 text-gray-700 text-lg leading-7">
                            <form x-ref="form" @submit.prevent="confirmSubmit" method="POST"
                                action="{{ route('orders.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mt-4">
                                    <div class="flex space-x-1">
                                        <x-input-label for="order-number" :value="__('Order number')" />
                                        <span class="text-red-600">*</span>
                                    </div>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                        Example: #asjd-9dsf-l8z1
                                    </p>
                                    <x-text-input id="order-number" class="block mt-1 w-full" type="text"
                                        name="order_number" x-model="order_number" required
                                        placeholder="Input your 14 digits number from your order" />
                                    <x-input-error :messages="$errors->get('order_number')" class="mt-2" />
                                </div>

                                <div class="mt-4">
                                    <div class="flex space-x-1">
                                        <x-input-label for="customer-name" :value="__('Your name')" />
                                        <span class="text-red-600">*</span>
                                    </div>
                                    <x-text-input id="customer-name" class="block mt-1 w-full" type="text"
                                        name="customer_name" x-model="customer_name" required />
                                    <x-input-error :messages="$errors->get('customer_name')" class="mt-2" />
                                </div>

                                <div class="mt-4">
                                    <div class="flex space-x-1">
                                        <x-input-label for="customer-phone-number" :value="__('Phone number')" />
                                        <span class="text-red-600">*</span>
                                    </div>
                                    <x-text-input id="customer-phone-number" class="block mt-1 w-full" type="number"
                                        name="customer_phone_number" x-model="customer_phone_number" required
                                        placeholder="0xx xxx xxx" />
                                    <x-input-error :messages="$errors->get('customer_phone_number')" class="mt-2" />
                                </div>

                                <div class="mt-4">
                                    <div class="flex space-x-1">
                                        <x-input-label for="floor" :value="__('Floor')" />
                                        <span class="text-red-600">*</span>
                                    </div>
                                    <x-text-input id="floor" class="block mt-1 w-full" type="number" name="floor"
                                        x-model="floor" required min="1" max="50" />
                                    <x-input-error :messages="$errors->get('floor')" class="mt-2" />
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="order-summary" :value="__(
                                        'Order summary (This is optional, but it will help deliver your order faster.)',
                                    )" />
                                    <div id="file-upload"
                                        class="pt-5 pb-6 mt-1 flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100"
                                        @click="triggerFileInput">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                class="font-semibold">Click to upload</span> or drag and drop</p>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                class="font-semibold">Only JPG, PNG, and GIF are allowed.</span></p>

                                        <img id="image-preview" class="w-full h-full object-contain mt-2 hidden" />
                                    </div>
                                    <input id="order-summary" name="order_summary" type="file" class="hidden"
                                        x-ref="order_summary" @change="handleFileChange" />
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

            <!-- Confirmation Popup -->
            <div x-show="showModal" class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title"
                role="dialog" aria-modal="true">
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div x-show="showModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                        aria-hidden="true"></div>

                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>

                    <div x-show="showModal"
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                        Confirm Submission
                                    </h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">Please confirm that the following information
                                            is correct:</p>
                                        <ul
                                            class="flex flex-col items-start px-10 sm:px-0 mt-3 list-disc list-inside text-sm text-start text-gray-700 overflow-x-auto">
                                            <li><strong>Order number:</strong> <span x-text="order_number"></span></li>
                                            <li><strong>Your name:</strong> <span x-text="customer_name"></span>
                                            </li>
                                            <li><strong>Phone number:</strong> <span
                                                    x-text="customer_phone_number"></span></li>
                                            <li><strong>Floor:</strong> <span x-text="floor"></span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 flex gap-3 flex-col sm:flex-row sm:justify-end">
                            <x-secondary-button @click="showModal = false">
                                {{ __('Cancel') }}
                            </x-secondary-button>

                            <x-primary-button id="submitButton" @click="submitForm">
                                <div class="flex items-center justify-center">
                                    <svg id="spinner" class="hidden animate-spin mr-2"
                                        xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z">
                                            <animateTransform attributeName="transform" dur="0.75s"
                                                repeatCount="indefinite" type="rotate" values="0 12 12;360 12 12" />
                                        </path>
                                    </svg>
                                    {{ __('Submit') }}
                                </div>
                            </x-primary-button>
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

    <script>
        function formHandler() {
            return {
                showModal: false,
                order_number: '',
                customer_name: '',
                customer_phone_number: '',
                floor: '',
                order_summary: null,
                triggerFileInput() {
                    this.$refs.order_summary.click();
                },
                handleFileChange(event) {
                    const file = event.target.files[0];
                    if (file) {
                        // Check file size
                        if (file.size > 2 * 1024 * 1024) { // 2MB limit
                            alert('File size should not exceed 2MB.');
                            return;
                        }
                        // Check file type
                        const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
                        if (!validTypes.includes(file.type)) {
                            alert('Invalid file type. Only JPG, PNG, and GIF are allowed.');
                            return;
                        }
                        this.order_summary = file.name;

                        // Remove any existing content in the file-upload div
                        const fileUploadDiv = document.getElementById('file-upload');
                        fileUploadDiv.innerHTML = '';

                        // Create and display the image preview
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            const img = document.createElement('img');
                            img.id = 'image-preview';
                            img.src = e.target.result;
                            img.classList.add('w-full', 'h-full', 'object-contain');
                            fileUploadDiv.appendChild(img); // Append the new image to the file-upload div
                        };
                        reader.readAsDataURL(file);
                    }
                },
                confirmSubmit() {
                    this.showModal = true;
                },
                submitForm() {
                    console.log("submit")
                    const submitButton = document.getElementById('submitButton');
                    const spinner = document.getElementById('spinner');

                    // Disable the button and show the spinner
                    submitButton.disabled = true;
                    spinner.classList.remove('hidden');

                    // Submit the form
                    this.$refs.form.submit();
                }
            }
        }
    </script>
</x-guest-layout>
