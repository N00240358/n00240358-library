    <!-- @props(['title', 'premiere_date', 'description', 'image'])
    <div class="border rounded-lg shadow-md p-6 bg-white hover:shadow-lg transition duration-300 max-w-xl mx-auto">
        
        <h1 class="font-bold text-black-600 mb-2">{{$title}}</h1>
        
        <div class="overflow-hidden rounded-lg mb-4 flex justify-content">
            <img src="{{ asset('images/musicals/' . $image) }}" alt="{{ $title }}" class="w-full max-w-xs h-auto object-cover">
        </div>
        
        <h2 class="text-grey-500 text-sm italic mb-4" style="font-size:1rem;">Premiere Date: {{ $premiere_date }}</h2>
        
        <h3 class="text-grey-800 font-semibold mb-2" style="font-size:2rem;">Description</h3>
        <p class="text-grey-700 leading-relaxed">{{ $description }}</p>
    </div> -->

    @props(['title', 'premiere_date' => null, 'description' => null, 'image' => null])

<div class="border rounded-lg shadow-md p-6 bg-white hover:shadow-lg transition duration-300 max-w-xl mx-auto">
    <!-- Title -->
    <h1 class="font-bold text-black-600 mb-2">{{ $title }}</h1>

    <!-- Image -->
    @if($image)
        <div class="overflow-hidden rounded-lg mb-4 flex justify-center">
            <img src="{{ asset('images/musicals/' . $image) }}" 
                 alt="{{ $title }}" 
                 class="w-full max-w-xs h-auto object-cover">
        </div>
    @endif

    <!-- Premiere Date -->
    @if($premiere_date)
        <h2 class="text-gray-500 text-sm italic mb-4" style="font-size:1rem;">
            Premiere Date: {{ $premiere_date }}
        </h2>
    @endif

    <!-- Description -->
    @if($description)
        <h3 class="text-gray-800 font-semibold mb-2" style="font-size:1.25rem;">Description</h3>
        <p class="text-gray-700 leading-relaxed">{{ $description }}</p>
    @endif
</div>
