@props(['actor'])

<div class="mt-8">
    {{-- Name --}}
    <h1 class="font-bold text-[#f2c94c] mb-3 text-3xl">{{ $actor->name }}</h1>

    {{-- Birthdate --}}
    @if($actor->birthdate)
        <h2 class="text-[#f2c94c] text-base italic mb-3">Date of Birth: {{ $actor->birthdate }}</h2>
    @endif

    {{-- Biography --}}
    @if($actor->biography)
        <h3 class="text-[#f2c94c] font-semibold mb-2 text-xl">Biography</h3>
        <p class="text-gray-200 leading-relaxed">{{ $actor->biography }}</p>
    @endif

    {{-- Musicals --}}
    @if($actor->musicals->count())
        <h3 class="text-[#f2c94c] font-semibold mt-4">Musicals:</h3>
        <ul class="list-disc list-inside text-gray-200">
            @foreach($actor->musicals as $musical)
                <li>{{ $musical->title }}</li>
            @endforeach
        </ul>
    @endif
</div>
