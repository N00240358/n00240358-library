@props(['action', 'method', 'musical', 'song' => null])


<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($method === 'PUT' || $method === 'PATCH')
        @method($method)
    @endif

    {{-- Title --}}
    <div class="mb-4">
        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
        <input 
            type="text"
            name="title"
            id="title"
            value="{{ old('title', $song->title ?? '') }}"
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
        />
        @error('title')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Duration --}}
        <div class="mb-4">
        <label for="duration" class="block text-sm font-medium text-gray-700">Duration</label>
        <input 
            type="text"
            name="duration"
            id="duration"
            value="{{ old('duration', $song->duration ?? '') }}"
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
        />
        @error('duration')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Composer --}}
        <div class="mb-4">
        <label for="composer" class="block text-sm font-medium text-gray-700">Composer</label>
        <input 
            type="text"
            name="composer"
            id="composer"
            value="{{ old('composer', $song->composer ?? '') }}"
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
        />
        @error('composer')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    {{-- Buttons --}}
    <div class="flex items-center space-x-2">
        <x-primary-button>
            {{ isset($song) ? 'Update Song' : 'Create Song' }}
        </x-primary-button>

        {{-- Cancel Button --}}
        <button type="button" 
                onclick="window.location='{{ route('musicals.show', $musical->id) }}'" 
                class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md">
            Cancel
        </button>
    </div>
</form>