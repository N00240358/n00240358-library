<x-app-layout>
    {{-- Styling for the New Song button on the navbar as well as the code for routing the user to the correct place. --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#2b1b1b] overflow-hidden shadow-sm sm:rounded-lg border border-yellow-600/40">
                <div class="p-6 text-white">
                    <h3 class="font-semibold text-lg mb-4 text-[#f2c94c]">Add a New Musical:</h3>
                    <x-song-form
                        :action="route('songs.store', $musical)" 
                        :method="'POST'"
                        :musical="$musical" {{-- passes the musical to the song form to associate the new song with the correct musical --}}
                    />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>