{{-- Alert for successful actions --}}
<x-alert-success>
    {{ session('success') }} <!-- displays success message -->
</x-alert-success>

<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-grey-800 leading-tight">
            {{ __('All Musicals') }}
        </h2>
    </x-slot> --}}
    {{-- Styling for the index with each musical being called and put in their own cards. --}}
    <div class="py-12 bg-[#1a1a1a] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#2b1b1b] border border-yellow-600/30 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <h3 class="font-semibold text-lg mb-4 text-[#f2c94c] border-b border-yellow-600/40 pb-2">List of Musicals</h3>
                    {{-- The Musical Cards along with the grid system they use --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($musicals as $musical)
                            <div class="bg-[#1f1f1f] border border-yellow-700/40 p-5 rounded-xl shadow-md hover:shadow-yellow-600/20 transition transform hover:-translate-y-1 duration-300">
                                <a href="{{ route('musicals.show', $musical) }}"> {{-- links to the show method in the MusicalController with the correct id --}}
                                    <x-musical-card
                                        :title="$musical->title" {{-- pulls the title from the database with the correct id --}}
                                        :image="$musical->image" {{-- pulls the image from the database with the correct id --}}
                                        :director="$musical->director" {{-- pulls the director from the database with the correct id --}}
                                    />
                                </a>

                                @if(auth()->user()->role === 'admin') 
                                {{-- Edit and Delete Buttons --}}
                                <div class="mt-4 flex justify-between">
                                    <!-- Edit Button -->
                                    <a href="{{ route('musicals.edit', $musical) }}" 
                                        class="bg-[#f2c94c] hover:bg-yellow-400 text-[#2b1b1b] font-bold py-2 px-4 rounded-lg shadow-md transition">
                                        Edit
                                    </a> {{-- links to the edit method in the MusicalController with the correct id --}}
                                    <!-- Delete Button -->
                                    <div x-data="{ open: false }"> {{-- Alpine.js state for showing the modal --}}
                                        {{-- Trigger button --}}
                                        <button @click="open = true"                                    
                                        class="bg-red-500 hover:bg-red-600 text-gray-100 font-bold py-2 px-4 rounded-lg shadow-md transition">
                                        Delete
                                        </button> {{-- opens the confirmation modal --}}
                                    
                                        {{-- Confirmation Modal --}}
                                        <div x-show="open" 
                                             class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
                                             x-transition>
                                            <div @click.away="open = false" {{-- closes modal if clicking outside --}}
                                                 class="bg-[#2b1b1b] text-white rounded-lg shadow-lg p-6 w-96">
                                                <h2 class="text-xl font-bold mb-4">Confirm Deletion</h2>
                                                <p class="mb-6">Are you sure you want to delete this musical? This action cannot be undone.</p>
                                                <div class="flex justify-end space-x-4">
                                                    {{-- Cancel button --}}
                                                    <button @click="open = false" 
                                                        class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded font-bold">
                                                        Cancel
                                                    </button> {{-- closes the modal without deleting --}}
                                                
                                                    {{-- Delete form --}}
                                                    <form action="{{ route('musicals.destroy', $musical) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                        class="px-4 py-2 bg-red-500 hover:bg-red-600 rounded font-bold">
                                                        Delete
                                                        </button> {{-- submits to the destroy method in the MusicalController with the correct id, deletes everything from the database and also from the image folder --}}
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>