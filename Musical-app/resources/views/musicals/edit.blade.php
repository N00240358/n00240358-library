<x-app-layout>
    {{-- Styling for the Edit Musical button on the navbar as well as the code for routing the user to the correct place. --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#2b1b1b] overflow-hidden shadow-sm sm:rounded-lg border border-yellow-600/40">
                <div class="p-6 text-white">
                    <h3 class="font-semibold text-lg mb-4 text-[#f2c94c]">Edit Musical</h3>

                    {{-- Musical Form --}}
                    <x-musical-form
                        :action="route('musicals.update', $musical)" {{-- routes to the update method in the MusicalController to then the Musical Form --}}
                        :method="'PUT'"
                        :musical="$musical" {{-- passes the musical data to the form to prefill with existing data --}}
                    />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>