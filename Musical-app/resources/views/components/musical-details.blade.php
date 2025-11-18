@props(['title', 'premiere_date', 'description', 'image', 'duration', 'director', 'video' => null]) {{-- gets title, premiere date, description, image, video, and other data as properties to call from the database --}}

@php
    // Convert a normal YouTube link into an embeddable link
    if (!empty($video) && str_contains($video, 'watch?v=')) {
        $video = str_replace('watch?v=', 'embed/', $video);
    }
@endphp

<div {{-- Alpine component --}}
x-data="{
    showVideo: false,
    player: null,
    init() {
        // Loads an instances of the youtube API for the iframe
        const tag = document.createElement('script');
        tag.src = 'https://www.youtube.com/iframe_api';
        document.body.appendChild(tag);

        // When the API is loaded the player is created
        window.onYouTubeIframeAPIReady = () => {
            this.player = new YT.Player(this.$refs.video, {
                events: {
                    onReady: (event) => {
                        event.target.mute(); // mute the video for the autoplay to work
                    },
                    onStateChange: (event) => {
                        if (event.data === YT.PlayerState.ENDED) {
                            this.showVideo = false; // when the video finishes the video is hidden for the image to come out
                        }
                    }
                }
            });
        };
    },
    playVideo() {
        this.showVideo = true;
        this.$nextTick(() => {
            if (this.player && this.player.playVideo) {
                this.player.playVideo();
            }
        });
    }
}"
    class="border rounded-lg shadow-md p-8 bg-[#2b1b1b] hover:shadow-lg transition duration-300 max-w-6xl mx-auto border-yellow-600/40"
> {{-- expanded border --}}

    {{-- Container with black background; image and video overlap --}}
    <div class="flex justify-center items-center bg-black w-full h-[32rem] overflow-hidden relative rounded-lg">
        @if($image)
            <img 
                src="{{ asset('images/musicals/' . $image) }}" {{-- gets image from folder --}}
                alt="{{ $title }}"
                class="w-80 h-[28rem] object-cover rounded-md shadow-md cursor-pointer transition duration-300"
                x-show="!showVideo"
                @click="playVideo()"
            > {{-- fills container, larger width and height --}}
        @endif

        {{-- iframe always exists in DOM so YouTube API can attach events --}}
        @if(!empty($video))
            <iframe
                x-ref="video"
                x-show="showVideo"
                x-transition
                src="{{ $video }}?enablejsapi=1&mute=1" {{-- Video will be both autoplay and muted --}}
                title="{{ $title }} video"
                class="absolute w-[50rem] h-[28rem] rounded-lg shadow-md"
                allow="autoplay; encrypted-media"
                allowfullscreen
                loading="lazy"
            ></iframe>
        @endif
    </div>
</div>

{{-- Musical Info Below Image and Video --}}
<div class="mt-8">
    {{-- Title --}}
    <h1 class="font-bold text-gray-200 mb-3 text-3xl">{{ $title }}</h1> {{-- slightly larger title --}}

    {{-- Director --}}
    @if($director)
        <h2 class="text-[#f2c94c] text-base italic mb-3">
            Directed by:
            <span class="text-gray-200">{{ $director }}</span>
        </h2>
    @endif

    {{-- Premiere Date and Duration on the same line --}}
    @if($premiere_date || $duration)
        <div class="flex flex-wrap justify-between text-sm italic mb-5">
            @if($premiere_date)
                <span class="text-[#f2c94c]">
                    Premiere Date:
                    <span class="text-gray-200">{{ $premiere_date }}</span>
                </span>
            @endif

            @if($duration)
                <span class="text-[#f2c94c]">
                    Duration:
                    <span class="text-gray-200">{{ $duration }} Minutes</span>
                </span>
            @endif
        </div>
    @endif

    {{-- Description --}}
    @if($description)
        <h3 class="text-[#f2c94c] font-semibold mb-2 text-xl">Description</h3>
        <p class="text-gray-200 leading-relaxed">{{ $description }}</p> {{-- displays description --}}
    @endif
</div>