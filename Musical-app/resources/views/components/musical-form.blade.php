@props(['action', 'method', 'musical']) <!-- gets action, method, and musical as properties to call from the database -->

<form action="{{ $action }}" method="POST" enctype="multipart/form-data"> {{-- form to create or edit a musical --}}
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
            value="{{ old('title', $musical->title ?? '') }}"  {{-- if there is an old value from a failed validation will use it, otherwise get the title from the id if editing --}}
            required
            class="mt-1 block w-2/3 border-gray-300 rounded-md shadow-sm bg-[#2b1b1b] text-white" />
        @error('title')
            <p class="text-sm text-red-600">{{ $message }}</p> <!-- displays error message if validation fails -->
        @enderror
    </div>

    {{-- Description --}}
    <div class="mb-4">
        <label for="description" class="block text-sm text-white">Description</label>
        <textarea 
            name="description"
            id="description"
            rows="6"
            class="mt-1 block w-5/6 h-40 border-gray-300 rounded-md shadow-sm resize-y bg-[#2b1b1b] text-white">{{ old('description', $musical->description ?? '') }}</textarea> {{-- if there is an old value from a failed validation will use it, otherwise get the description from the id if editing --}}
        @error('description')
            <p class="text-sm text-red-600">{{ $message }}</p> <!-- displays error message if validation fails -->
        @enderror
    </div>

    {{-- Duration --}}
    <div class="mb-4">
        <label for="duration" class="block text-sm text-white">Duration</label>
        <input 
            type="text"
            name="duration"
            id="duration"
            value="{{ old('duration', $musical->duration ?? '') }}" {{-- if there is an old value from a failed validation will use it, otherwise get the duration from the id if editing --}}
            required
            class="mt-1 block w-32 border-gray-300 rounded-md shadow-sm text-center bg-[#2b1b1b] text-white" /> 
        @error('duration')
            <p class="text-sm text-red-600">{{ $message }}</p> <!-- displays error message if validation fails -->
        @enderror
    </div>

    {{-- Premiere Date --}}
    <div class="mb-4">
        <label for="premiere_date" class="block text-sm text-white">Premiere Date</label>
        <input 
            type="text"
            name="premiere_date"
            id="premiere_date"
            value="{{ old('premiere_date', $musical->premiere_date ?? '') }}" {{-- if there is an old value from a failed validation will use it, otherwise get the premiere date from the id if editing --}}
            required
            class="mt-1 block w-52 border-gray-300 rounded-md shadow-sm bg-[#2b1b1b] text-white" />
        @error('premiere_date')
            <p class="text-sm text-red-600">{{ $message }}</p> <!-- displays error message if validation fails -->
        @enderror
    </div>

    {{-- Director --}}
    <div class="mb-4">
        <label for="director" class="block text-sm text-white">Director</label>
        <input 
            type="text"
            name="director"
            id="director"
            value="{{ old('director', $musical->director ?? '') }}" {{-- if there is an old value from a failed validation will use it, otherwise get the director from the id if editing --}}
            required
            class="mt-1 block w-1/2 border-gray-300 rounded-md shadow-sm bg-[#2b1b1b] text-white" /> 
        @error('director')
            <p class="text-sm text-red-600">{{ $message }}</p> <!-- displays error message if validation fails -->
        @enderror
    </div>

    {{-- Video URL --}}
<div class="mb-4">
    <label for="video" class="block text-sm text-white">Video URL</label>
    <input
        type="text"
        name="video"
        id="video"
        value="{{ old('video', $musical->video ?? '') }}" {{-- if there is an old value from a failed validation will use it, otherwise get the video URL from the musical if editing --}}
        class="mt-1 block w-5/6 border-gray-300 rounded-md shadow-sm bg-[#2b1b1b] text-white"
        placeholder="Enter a YouTube or Vimeo URL" />
    @error('video')
        <p class="text-sm text-red-600">{{ $message }}</p> <!-- displays error message if validation fails -->
    @enderror
</div>


{{-- Image --}}
<div class="mb-4">
    <label for="image" class="block text-sm font-medium text-white">Musical Cover Image</label>

    {{-- Custom file input --}}
    <div class="mt-1 flex items-center space-x-4">
        <label for="image" 
               class="cursor-pointer inline-flex items-center px-4 py-2 bg-[#f2c94c] text-[#2b1b1b] font-bold rounded-md shadow-md hover:bg-yellow-400 transition">
            Select File {{-- This replaces the default (Choose File) button --}}
        </label>

        <span class="text-white" id="file-name">No file chosen</span> {{-- shows image name --}}

        <input
            type="file"
            name="image"
            id="image"
            class="hidden" {{-- hide the default input for styling --}}
            {{ isset($musical) ? '' : 'required' }} {{-- image is required when creating a new musical but not when editing as when edit it is nullable --}}
            onchange="document.getElementById('file-name').textContent = this.files[0]?.name || 'No file chosen'"/>
    </div>

    @error('image')
        <p class="text-sm text-red-600">{{ $message }}</p> <!-- displays error message if validation fails -->
    @enderror
</div>

    @isset($musical->image)
    <div class="mb-4">
        <img src="{{ asset('images/musicals/' .$musical->image) }}" alt="Musical cover" class="w-24 h-32 object-cover"> <!-- displays current image when editing to check if the image is correct-->  
    </div>
    @endisset

    <div class="flex space-x-4 mt-4">
        <x-primary-button>
            {{ isset($musical) ? 'Update Musical' : 'Add Musical' }} <!-- changes button text depending on if creating or editing -->
        </x-primary-button>

        <a href="{{ route('musicals.index') }}" {{-- A button that is using the same styling as the primary button to go back to the index without making any changes. --}}
           class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-[#f2c94c] font-bold rounded-md shadow-md transition">
            Cancel
        </a>
    </div>
</form>