@props(['title', 'image'])

<div class="border rounded-lg shadow-md p-6 bg-white hover:shadow-lg transition duration-300">
    <h4 class="font-bold text-lg mb-4">{{ $title }}</h4>

    <div class="w-full h-80 overflow-hidden rounded">
        <img 
            src="{{ asset('images/musicals/' . $image) }}" 
            alt="{{ $title }}" 
            class="w-full h-full object-cover"
        >
    </div>
</div>
