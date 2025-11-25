@props(['musical'])

<form action="{{ route('checkout.pay', $musical->id) }}" method="POST" class="max-w-md mx-auto mt-10 p-8 bg-gray-900 rounded-xl shadow-lg border border-yellow-500">
    @csrf

    {{-- Header --}}
    <h2 class="text-3xl font-bold text-yellow-400 mb-6 text-center">Tickets for {{ $musical->title }}!</h2>
    <p class="text-gray-300 mb-6 text-center">Test payment, no real charges will be made.</p>

    {{-- Card Number --}}
    <div class="mb-4">
        <label for="card_number" class="block text-sm text-white font-semibold mb-1">Card Number</label>
        <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                💳
            </span>
            <input 
                type="text" 
                name="card_number" 
                id="card_number" 
                value="4242424242424242"
                placeholder="4242 4242 4242 4242" 
                required
                class="mt-1 block w-full pl-10 border border-yellow-500 rounded-md shadow-sm bg-gray-800 text-white focus:ring-yellow-500 focus:border-yellow-400 p-2"
            >
        </div>
    </div>

    {{-- Expiration + CVC --}}
    <div class="flex space-x-4 mb-4">
        <div class="flex-1">
            <label for="exp_month" class="block text-sm text-white font-semibold mb-1">Exp. Month</label>
            <input 
                type="text" 
                name="exp_month" 
                id="exp_month" 
                value="12" 
                placeholder="MM" 
                required
                class="mt-1 block w-full border border-yellow-500 rounded-md shadow-sm bg-gray-800 text-white focus:ring-yellow-500 focus:border-yellow-400 p-2"
            >
        </div>
        <div class="flex-1">
            <label for="exp_year" class="block text-sm text-white font-semibold mb-1">Exp. Year</label>
            <input 
                type="text" 
                name="exp_year" 
                id="exp_year" 
                value="34" 
                placeholder="YY" 
                required
                class="mt-1 block w-full border border-yellow-500 rounded-md shadow-sm bg-gray-800 text-white focus:ring-yellow-500 focus:border-yellow-400 p-2"
            >
        </div>
        <div class="flex-1">
            <label for="cvc" class="block text-sm text-white font-semibold mb-1">CVC</label>
            <input 
                type="text" 
                name="cvc" 
                id="cvc" 
                value="123" 
                placeholder="CVC" 
                required
                class="mt-1 block w-full border border-yellow-500 rounded-md shadow-sm bg-gray-800 text-white focus:ring-yellow-500 focus:border-yellow-400 p-2"
            >
        </div>
    </div>

    {{-- Amount --}}
    <div class="mb-6 text-center">
        <p class="text-gray-300 text-lg">Amount: <span class="font-bold text-yellow-400">€10.00</span></p>
    </div>

    {{-- Buttons --}}
    <div class="flex flex-col space-y-4">
        <button type="submit" class="w-full px-4 py-3 bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold rounded-lg shadow-md transition text-lg">
            Pay €10
        </button>
        <a href="{{ route('musicals.show', $musical) }}" class="w-full px-4 py-3 bg-gray-700 hover:bg-gray-600 text-yellow-400 font-bold rounded-lg shadow-md transition text-center text-lg">
            Cancel
        </a>
    </div>
</form>
