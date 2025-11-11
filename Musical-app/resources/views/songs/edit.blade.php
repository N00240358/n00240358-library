{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Song') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4">Edit Song:</h3>

                    <x-song-form
                        :action="route('songs.update', $song)" {{-- routes to the update method in the SongController to then the Song Form --}}
                        {{-- :method="'PUT'"
                        :song="$song" {{-- passes the song data to the form to prefill with existing data --}}
                        {{-- :musical="$song->musical" 
                    />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>    --}}

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#2b1b1b] overflow-hidden shadow-sm sm:rounded-lg border border-yellow-600/40">
                <div class="p-6 text-white">
                    <h3 class="font-semibold text-lg mb-4 text-[#f2c94c]">Edit Song</h3>

                    <x-song-form
                        :action="route('songs.update', $song)"
                        :method="'PUT'"
                        :musical="$musical"  {{-- ✅ make sure this is passed --}}
                        :song="$song"
                    />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
