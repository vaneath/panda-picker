<x-guest-layout>
    <div class="py-12">
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
                            <div class="mt-4">
                                <x-input-label for="order-number" :value="__('Order Number')" />

                                <x-text-input id="order-number" class="block mt-1 w-full" type="text"
                                    name="order-number" required autocomplete="current-order-number" />

                                <x-input-error :messages="$errors->get('order-number')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="customer-name" :value="__('Your Name')" />

                                <x-text-input id="customer-name" class="block mt-1 w-full" type="text"
                                    name="customer-name" required autocomplete="current-customer-name" />

                                <x-input-error :messages="$errors->get('customer-name')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="customer-phone-number" :value="__('Phone Number')" />

                                <x-text-input id="customer-phone-number" class="block mt-1 w-full" type="number"
                                    name="customer-phone-number" required
                                    autocomplete="current-customer-phone-number" />

                                <x-input-error :messages="$errors->get('customer-phone-number')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="floor" :value="__('Floor')" />

                                <x-text-input id="floor" class="block mt-1 w-full" type="number" name="floor"
                                    required autocomplete="current-floor" min="1" max="50" />

                                <x-input-error :messages="$errors->get('floor')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="order-summary" :value="__('Order Summary')" />

                                <div
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
                                <input id="order-summary" type="file" class="hidden" />

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
