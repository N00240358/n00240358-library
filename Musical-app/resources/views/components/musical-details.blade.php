@props(['title', 'premiere_date', 'description', 'image', 'duration', 'director', 'video' => null]) <!-- gets title, premiere date, description, image, video, and other data as properties to call from the database -->

@php
    // Convert a normal YouTube link into an embeddable link with autoplay and muted
    if (!empty($video) && str_contains($video, 'watch?v=')) {
        $video = str_replace('watch?v=', 'embed/', $video) . '?autoplay=1&mute=1';
    }
@endphp


<div class="border rounded-lg shadow-md p-8 bg-[#2b1b1b] hover:shadow-lg transition duration-300 max-w-6xl mx-auto border-yellow-600/40"> <!-- expanded border -->

    <div class="flex flex-col md:flex-row md:space-x-8 justify-between"> <!-- spread out image and video -->
        <!-- Image on the left -->
        @if($image)
            <div class="flex-shrink-0 mb-6 md:mb-0 w-80 h-[28rem]"> <!-- set width and height for consistency -->
                <img src="{{ asset('images/musicals/' . $image) }}" {{-- gets image from folder --}}
                     alt="{{ $title }}"
                     class="w-full h-full object-cover rounded-md shadow-md"> <!-- fills container, larger width and height -->
            </div>
        @endif

<!-- Video on the right -->
@if(!empty($video))
    <div class="flex-shrink-0 mb-6 md:mb-0 w-[29rem] h-[28rem]"> <!-- increased width by 5rem -->
        <div class="w-full h-full rounded-lg overflow-hidden shadow-md"> <!-- match height to image -->
            <iframe 
                src="{{ $video }}" {{-- gets video link from database --}}
                title="{{ $title }} video"
                class="w-full h-full rounded-lg"
                allowfullscreen
                loading="lazy">
            </iframe>
        </div>
    </div>
@endif


    </div>
</div>


    <!-- Musical Info Below Image and Video -->
    <div class="mt-8">
        <!-- Title -->
        <h1 class="font-bold text-[#f2c94c] mb-3 text-3xl">{{ $title }}</h1> <!-- slightly larger title -->

        <!-- Director -->
        @if($director)
            <h2 class="text-[#f2c94c] text-base italic mb-3">Directed by: {{ $director }}</h2> <!-- displays Director -->
        @endif

        <!-- Premiere Date and Duration on the same line -->
        @if($premiere_date || $duration)
            <div class="flex flex-wrap justify-between text-[#f2c94c] text-sm italic mb-5">
                @if($premiere_date)
                    <span>Premiere Date: {{ $premiere_date }}</span>
                @endif
                @if($duration)
                    <span>Duration: {{ $duration }} minutes</span>
                @endif
            </div> <!-- displays premiere date and duration on the same line -->
        @endif

        <!-- Description -->
        @if($description)
            <h3 class="text-[#f2c94c] font-semibold mb-2 text-xl">Description</h3>
            <p class="text-gray-200 leading-relaxed">{{ $description }}</p> <!-- displays description -->
        @endif
    </div>
</div>
