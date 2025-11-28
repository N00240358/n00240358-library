<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#2b1b1b] overflow-hidden shadow-sm sm:rounded-lg border border-yellow-600/40">
                <div class="p-6 text-white">
                    <h3 class="font-semibold text-lg mb-4 text-[#f2c94c]">Edit Song</h3>
                    
                    <x-song-form
                        :action="route('songs.update', $song)"
                        :method="'PUT'"
                        :musical="$musical" {{-- passes the musical to the song form to associate the song with the correct musical --}}
                        :song="$song" {{-- passes the song data to the form to prefill with existing data --}}
                    />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
