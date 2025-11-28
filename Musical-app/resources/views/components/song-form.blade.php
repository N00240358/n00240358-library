@props(['action', 'method', 'musical', 'song' => null]) {{-- gets action, method, musical and song as properties to call from the database --}}

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($method === 'PUT' || $method === 'PATCH')
        @method($method)
    @endif

    {{-- Title --}}
    <div class="mb-4">
        <label for="title" class="block text-sm text-white">Title</label>
        <input 
            type="text"
            name="title"
            id="title"
            value="{{ old('title', $song->title ?? '') }}" {{-- if there is an old value from a failed validation will use it, otherwise get the title from the id if editing --}}
            required
            class="mt-1 block w-2/3 border-gray-300 rounded-md shadow-sm bg-[#2b1b1b] text-white focus:ring-yellow-500 focus:border-yellow-500"
        />
        @error('title')
            <p class="text-sm text-red-600">{{ $message }}</p> <!-- displays error message if validation fails -->
        @enderror
    </div>

    {{-- Duration --}}
    <div class="mb-4">
        <label for="duration" class="block text-sm text-white">Duration (minutes)</label>
        <input 
            type="number"
            name="duration"
            id="duration"
            step="0.01"      
            min="0.01"        
            max="60"
            value="{{ old('duration', $song->duration ?? '') }}" {{-- if there is an old value from a failed validation will use it, otherwise get the duration from the id if editing --}}
            required
            class="mt-1 block w-32 text-center border-gray-300 rounded-md shadow-sm bg-[#2b1b1b] text-white focus:ring-yellow-500 focus:border-yellow-500"
        />
        @error('duration')
            <p class="text-sm text-red-600">{{ $message }}</p> <!-- displays error message if validation fails -->
        @enderror
    </div>

    {{-- Composer --}}
    <div class="mb-4">
        <label for="composer" class="block text-sm text-white">Composer</label>
        <input 
            type="text"
            name="composer"
            id="composer"
            value="{{ old('composer', $song->composer ?? '') }}" {{-- if there is an old value from a failed validation will use it, otherwise get the composer from the id if editing --}}
            required
            class="mt-1 block w-1/2 border-gray-300 rounded-md shadow-sm bg-[#2b1b1b] text-white focus:ring-yellow-500 focus:border-yellow-500"
        />
        @error('composer')
            <p class="text-sm text-red-600">{{ $message }}</p> <!-- displays error message if validation fails -->
        @enderror
    </div>

    {{-- Buttons --}}
    <div class="flex space-x-4 mt-4">
        <x-primary-button>
            {{ isset($song) ? 'Update Song' : 'Add Song' }} <!-- changes button text depending on if creating or editing -->
        </x-primary-button>

        @if($musical && $musical->exists) {{-- if musical exists, go back to musical show page --}}
            <a href="{{ route('musicals.show', $musical) }}"
               class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-[#f2c94c] font-bold rounded-md shadow-md transition">
                Cancel
            </a>
        @else {{-- else go back to musicals index page --}}
            <a href="{{ route('musicals.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-[#f2c94c] font-bold rounded-md shadow-md transition">
                Cancel
            </a>
        @endif
    </div>
</form>
