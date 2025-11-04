<x-app-layout>
    {{-- Styling for the show musical page along with calling the musical details component to display the information of the musical --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#2b1b1b] overflow-hidden shadow-sm sm:rounded-lg border border-yellow-600/40">
                <div class="p-6 text-gray-200">
                    <!-- Go Back Button -->
                    <a href="{{ route('musicals.index') }}" {{-- A button that is using the same styling as the primary button to go back to the index without making any changes. --}}
                       class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-[#f2c94c] font-bold rounded-md shadow-md transition">
                        Go Back
                    </a>

                    {{-- <h3 class="font-semibold text-lg mb-4 text-[#f2c94c]">Musical Details</h3> --}}

                    <x-musical-details
                        :title="$musical->title" {{-- pulls the title from the database with the correct id --}}
                        :image="$musical->image" {{-- pulls the image from the database with the correct id --}}
                        :premiere_date="$musical->premiere_date" {{-- pulls the premiere date from the database with the correct id --}}
                        :description="$musical->description" {{-- pulls the description from the database with the correct id --}}
                        :director="$musical->director" {{-- pulls the director from the database with the correct id --}}
                        :duration="$musical->duration" {{-- pulls the duration from the database with the correct id --}}
                        :video="$musical->video" {{-- pulls the video from the database with the correct id --}}
                    />

                    {{-- All Songs --}}
                    <h4 class="font-semibold text-md mt-8">Songs</h4>
                    @if($musical->songs->isEmpty())
                        <p class="mt-2">No songs available for this musical.</p>
                    @else
                        <ul class="mt-4 space-y-4">
                            @foreach($musical->songs as $song)
                            <li class="bg-gray-100 p-4 rounded-lg">
                                <p class="font-semibold">{{ $song->title }}</p>
                                <p>Composer: {{ $song->composer }}</p>
                                <p>Duration: {{  $song->duration }}</p>

@if (auth()->user()->role === 'admin')
<div class="flex gap-4 mt-2">
    <a href="{{ route('songs.edit', $song) }}" 
       class="bg-yellow-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">
        {{ __('Edit Song') }}
    </a>
    <form method="POST" action="{{ route('songs.destroy', $song) }}">
        @csrf
        @method('delete')
        <x-danger-button :href="route('songs.destroy', $song)"
            onclick="event.preventDefault(); this.closest('form').submit();">
            {{ __('Delete Song') }}
        </x-danger-button>
    </form>
</div>
@endif

                            </li>
                            @endforeach
                        </ul>
                    @endif

                    {{-- Add new Song --}}
                    <h4 class="font-semibold text-md mt-8">Add a Song</h4>
                    <form action="{{ route('songs.store', $musical) }}" method="POST" class="mt-4">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block font-medium texxt-sm text-gray-700">Title</label>
                            <textarea name="title" id="title" rows="3" class="mt-1 block w-full"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="composer" class="block font-medium texxt-sm text-gray-700">Composer</label>
                            <textarea name="composer" id="composer" rows="3" class="mt-1 block w-full"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="duration" class="block font-medium texxt-sm text-gray-700">Duration</label>
                            <textarea name="duration" id="duration" rows="3" class="mt-1 block w-full"></textarea>
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add Song
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
