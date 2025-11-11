@props(['action', 'method', 'actor' => null, 'musicals' => [], 'actorMusical' => []])<!-- gets action, method, and actor as properties to call from the database -->

<form action="{{ $action }}" method="POST" enctype="multipart/form-data"> {{-- form to create or edit a actor --}}
    @csrf
    @if($method === 'PUT' || $method === 'PATCH') 
        @method($method) 
    @endif

    {{-- Name --}}
    <div class="mb-4">
        <label for="name" class="block text-sm text-white">Name</label>
        <input 
            type="text" 
            name="name" 
            id="name"
            value="{{ old('name', $actor->name ?? '') }}"  {{-- if there is an old value from a failed validation will use it, otherwise get the name from the id if editing --}}
            required
            class="mt-1 block w-2/3 border-gray-300 rounded-md shadow-sm bg-[#2b1b1b] text-white" />
        @error('name')
            <p class="text-sm text-red-600">{{ $message }}</p> <!-- displays error message if validation fails -->
        @enderror
    </div>

    {{-- Biography --}}
    <div class="mb-4">
        <label for="biography" class="block text-sm text-white">Biography</label>
        <textarea 
            name="biography"
            id="biography"
            rows="6"
            class="mt-1 block w-5/6 h-40 border-gray-300 rounded-md shadow-sm resize-y bg-[#2b1b1b] text-white">{{ old('biography', $actor->biography ?? '') }}</textarea> {{-- if there is an old value from a failed validation will use it, otherwise get the biography from the id if editing --}}
        @error('biography')
            <p class="text-sm text-red-600">{{ $message }}</p> <!-- displays error message if validation fails -->
        @enderror
    </div>

    {{-- Date of Birth --}}
    <div class="mb-4">
        <label for="birthdate" class="block text-sm text-white">Date of Birth</label>
        <input 
            type="text"
            name="birthdate"
            id="birthdate"
            value="{{ old('birthdate', $actor->birthdate ?? '') }}" {{-- if there is an old value from a failed validation will use it, otherwise get the Date of Birth from the id if editing --}}
            required
            class="mt-1 block w-52 border-gray-300 rounded-md shadow-sm bg-[#2b1b1b] text-white" />
        @error('birthdate')
            <p class="text-sm text-red-600">{{ $message }}</p> <!-- displays error message if validation fails -->
        @enderror
    </div>

    <div class="mb-4">
    <label class="block text-sm text-white mb-2">Musicals</label>
    @foreach($musicals as $musical)
        <label class="inline-flex items-center mr-4">
            <input type="checkbox" name="musicals[]" value="{{ $musical->id }}"
                @if(isset($actorMusical) && in_array($musical->id, $actorMusical)) checked @endif
                class="form-checkbox text-yellow-500"
            >
            <span class="ml-2 text-white">{{ $musical->title }}</span>
        </label>
    @endforeach
</div>


    <div class="flex space-x-4 mt-4">
        <x-primary-button>
            {{ isset($actor) ? 'Update Actor' : 'Add Actor' }} <!-- changes button text depending on if creating or editing -->
        </x-primary-button> 

        <a href="{{ route('actors.index') }}" {{-- A button that is using the same styling as the primary button to go back to the index without making any changes. --}}
           class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-[#f2c94c] font-bold rounded-md shadow-md transition">
            Cancel
        </a>
    </div>
</form>