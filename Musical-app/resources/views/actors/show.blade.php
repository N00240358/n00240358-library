<x-app-layout>
    {{-- Styling for the show actor page along with calling the actor details component to display the information of the actor --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#2b1b1b] overflow-hidden shadow-sm sm:rounded-lg border border-yellow-600/40">
                <div class="p-6 text-gray-200">
                    <!-- Go Back Button -->
                    <a href="{{ route('actors.index') }}" {{-- A button that is using the same styling as the primary button to go back to the index without making any changes. --}}
                       class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-[#f2c94c] font-bold rounded-md shadow-md transition">
                        Go Back
                    </a>

                    {{-- Actor Details Component --}}
                    <x-actor-details
                        :actor="$actor"
                    />
               </div>
            </div>
        </div>
    </div>
</x-app-layout>
