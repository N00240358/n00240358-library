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

                    {{-- Actors --}}
<h4 class="font-semibold text-lg mt-8 mb-4 text-[#f2c94c] border-b border-yellow-600/40 pb-2">Actors</h4>

@if($musical->actors->isEmpty())
    <p class="text-gray-300">No actors associated with this musical.</p>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($musical->actors as $actor)
            <div class="bg-[#1f1f1f] border border-yellow-700/40 rounded-xl shadow-md p-4 text-gray-200">
                <p class="font-bold text-[#f2c94c]">{{ $actor->name }}</p>
                @if($actor->role)
                    <p class="text-gray-300 text-sm">{{ $actor->role }}</p>
                @endif
            </div>
        @endforeach
    </div>
@endif


{{-- All Songs --}}
<h4 class="font-semibold text-lg mt-8 mb-4 text-[#f2c94c] border-b border-yellow-600/40 pb-2">Songs</h4>

{{-- Add new Song --}}
<div class="mt-6 mb-4">
    <a href="{{ route('songs.create', $musical) }}"
       class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-orange-700 text-white font-bold rounded-lg shadow-md transition">
       + Add New Song
    </a>
</div>

@if($musical->songs->isEmpty())
    <p class="text-gray-300">No songs available for this musical.</p>
@else
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" x-data="{ openSong: null }">
    @foreach($musical->songs as $song)
        <div class="bg-[#1f1f1f] border border-yellow-700/40 rounded-xl shadow-md hover:shadow-yellow-600/20 transition transform hover:-translate-y-1 duration-300 self-start">

            {{-- Song Header --}}
            <div class="p-5 cursor-pointer"
                 @click="openSong = (openSong === {{ $song->id }} ? null : {{ $song->id }})">
                <p class="font-bold text-lg text-[#f2c94c] truncate">{{ $song->title }}</p>
            </div>

            {{-- Collapsible content --}}
            <div x-show="openSong === {{ $song->id }}"
                 x-transition:enter="transition-all duration-300 ease-out"
                 x-transition:enter-start="max-h-0 opacity-0"
                 x-transition:enter-end="max-h-96 opacity-100"
                 x-transition:leave="transition-all duration-300 ease-in"
                 x-transition:leave-start="max-h-96 opacity-100"
                 x-transition:leave-end="max-h-0 opacity-0"
                 style="overflow:hidden;"
                 class="px-5 pb-5 text-gray-200">

                <p class="text-gray-300 mb-3"><span class="font-semibold">Composer:</span> {{ $song->composer }}</p>
                <p class="text-gray-300"><span class="font-semibold">Duration:</span> {{ $song->duration }} Minutes</p>

                @if(auth()->user()->role === 'admin')
                    <div class="flex justify-between gap-4 mt-3">
                        <!-- Edit Button -->
                        <a href="{{ route('songs.edit', $song) }}"
                           class="flex-1 bg-[#f2c94c] hover:bg-yellow-400 text-[#2b1b1b] font-bold py-2 px-4 rounded-lg shadow-md transition text-center">
                            Edit
                        </a>

                        <!-- Delete Button with Modal -->
                        <div x-data="{ openModal: false }" class="flex-1">
                            <button @click.stop="openModal = true"
                                    class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
                                Delete
                            </button>

                            <div x-show="openModal"
                                 class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
                                 x-transition>
                                <div @click.away="openModal = false"
                                     class="bg-[#2b1b1b] text-white rounded-lg shadow-lg p-6 w-96">
                                    <h2 class="text-xl font-bold mb-4">Confirm Deletion</h2>
                                    <p class="mb-6">Are you sure you want to delete this song? This action cannot be undone.</p>
                                    <div class="flex justify-end space-x-4">
                                        <button @click="openModal = false"
                                                class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded font-bold">
                                            Cancel
                                        </button>
                                        <form action="{{ route('songs.destroy', $song) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-4 py-2 bg-red-500 hover:bg-red-600 rounded font-bold">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    @endforeach
</div>
@endif
               </div>
            </div>
        </div>
    </div>
</x-app-layout>
