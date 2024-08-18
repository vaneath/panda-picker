@props(['status'])



<button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"
    type="button">Dropdown button <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
        fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
    </svg>
</button>

<!-- Dropdown menu -->
<div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
        <li>
            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Dashboard</a>
        </li>
        <li>
            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Settings</a>
        </li>
        <li>
            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Earnings</a>
        </li>
        <li>
            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Sign out</a>
        </li>
    </ul>
</div>
