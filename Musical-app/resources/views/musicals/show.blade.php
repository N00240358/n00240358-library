<x-app-layout>
    {{-- Styling for the show musical page along with calling the musical details component to display the information of the musical --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#2b1b1b] overflow-hidden shadow-sm sm:rounded-lg border border-yellow-600/40">
                <div class="p-6 text-gray-200">
                    <!-- Go Back Button -->
                    <a href="{{ route('musicals.index') }}" {{-- A button that is using the same styling as the primary button to go back to the index without making any changes. --}}
                       class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-[#f2c94c] font-bold rounded-md shadow-md transition">
                        Go Back
                    </a>

                    {{-- <h3 class="font-semibold text-lg mb-4 text-[#f2c94c]">Musical Details</h3> --}}

                    <x-musical-details
                        :title="$musical->title" {{-- pulls the title from the database with the correct id --}}
                        :image="$musical->image" {{-- pulls the image from the database with the correct id --}}
                        :premiere_date="$musical->premiere_date" {{-- pulls the premiere date from the database with the correct id --}}
                        :description="$musical->description" {{-- pulls the description from the database with the correct id --}}
                        :director="$musical->director" {{-- pulls the director from the database with the correct id --}}
                        :duration="$musical->duration" {{-- pulls the duration from the database with the correct id --}}
                        :video="$musical->video" {{-- pulls the video from the database with the correct id --}}
                    />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
