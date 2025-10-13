@props(['title', 'premiere_date', 'description', 'image', 'duration', 'director']) <!-- gets title, premiere date, description, and image as properties to call from the database -->

<div class="border rounded-lg shadow-md p-6 bg-[#2b1b1b] hover:shadow-lg transition duration-300 max-w-xl mx-auto border-yellow-600/40">
    <!-- Title -->
    <h1 class="font-bold text-[#f2c94c] mb-2 text-2xl">{{ $title }}</h1> <!-- displays title -->

    <!-- Image -->
    @if($image)
        <div class="overflow-hidden rounded-lg mb-4 flex justify-center"> <!-- centers image and sets size -->
            <img src="{{ asset('images/musicals/' . $image) }}" {{-- gets image from folder --}}
                 alt="{{ $title }}"
                 class="w-full max-w-xs h-auto object-cover rounded-md">
        </div>
    @endif

    <!-- Director -->
    @if($director)
        <h2 class="text-[#f2c94c] text-sm italic mb-4" style="font-size:1rem;">Directed by: {{ $director }}</h2> <!-- displays Director -->
    @endif

    <!-- Premiere Date and Duration on the same line -->
    @if($premiere_date || $duration)
        <div class="flex justify-between text-[#f2c94c] text-sm italic mb-4" style="font-size:1rem;">
            @if($premiere_date)
                <span>Premiere Date: {{ $premiere_date }}</span>
            @endif
            @if($duration)
                <span>Duration: {{ $duration }}</span>
            @endif
        </div> <!-- displays premiere date and duration on the same line -->
    @endif

    <!-- Description -->
    @if($description)
        <h3 class="text-[#f2c94c] font-semibold mb-2" style="font-size:1.25rem;">Description</h3>
        <p class="text-gray-200 leading-relaxed">{{ $description }}</p> <!-- displays description -->
    @endif
</div>
