@props(['action', 'method', 'musical'])

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($method === 'PUT' || $method === 'PATCH')
        @method($method)
    @endif

    {{-- Title --}}
    <div class="mb-4">
        <label for="title" class="block text-sm text-gray-700">Title</label>
        <input 
            type="text"
            name="title"
            id="title"
            value="{{ old('title', $musical->title ?? '') }}"
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        @error('title')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Description --}}
    <div class="mb-4">
        <label for="description" class="block text-sm text-gray-700">Description</label>
        <input 
            type="text"
            name="description"
            id="description"
            value="{{ old('description', $musical->description ?? '') }}"
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        @error('description')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Duration --}}
    <div class="mb-4">
        <label for="duration" class="block text-sm text-gray-700">Duration</label>
        <input 
            type="text"
            name="duration"
            id="duration"
            value="{{ old('duration', $musical->duration ?? '') }}"
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        @error('duration')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Premiere Date --}}
    <div class="mb-4">
        <label for="premiere_date" class="block text-sm text-gray-700">Premiere Date</label>
        <input 
            type="text"
            name="premiere_date"
            id="premiere_date"
            value="{{ old('premiere_date', $musical->premiere_date ?? '') }}"
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        @error('premiere_date')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Director --}}
    <div class="mb-4">
        <label for="director" class="block text-sm text-gray-700">Director</label>
        <input 
            type="text"
            name="director"
            id="director"
            value="{{ old('director', $musical->director ?? '') }}"
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        @error('director')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Image --}}
    <div class="mb-4">
        <label for="image" class="block text-sm font-medium text-gray-700">Musical Cover
Image</label>
    <input
        type="file"
        name="image"
        id="image"
        {{ isset($musical) ? '' : 'required' }}
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"/>
    @error('image')
        <p class="text-sm text-red-600">{{ $message}}</p>
    @enderror
    </div>

    @isset($musical->image)
    <div class="mb-4">
        <img src="{{ asset($musical->image) }}" alt="Musical cover" class="w-24 h-32 object-cover">    
    </div>
    @endisset

    <div>
        <x-primary-button>
         {{ isset($musical) ? 'Update Musical' : 'Add Musical' }}
        </x-primary-button>
            <a href="{{ route('musicals.index') }}" 
       class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
        Cancel
    </a>
    </div>
</form>