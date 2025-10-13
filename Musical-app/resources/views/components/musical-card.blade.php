@props(['title', 'image', 'director']) <!-- gets title and image as properties to call from the database -->

<div class="border rounded-lg shadow-md p-6 bg-[#2b1b1b] hover:shadow-lg transition duration-300 border-yellow-600/40"> 
    <h4 class="font-bold text-lg mb-4 text-[#f2c94c]">{{ $title }}</h4> <!-- displays title -->

    <div class="w-full h-80 overflow-hidden rounded"> <!-- sets size of image -->
        <img
            src="{{ asset('images/musicals/' . $image) }}" {{-- gets image from folder and expands it to full size for its container --}}
            alt="{{ $title }}"
            class="w-full h-full object-cover rounded-md"
        >
    </div>

    <h5 class="font-bold text-lg mb-4 text-[#f2c94c]">Directed by: {{ $director }}</h5> <!-- displays director -->
</div>
