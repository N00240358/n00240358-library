<x-app-layout>
    {{-- Styling for the Edit actor button on the navbar as well as the code for routing the user to the correct place. --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#2b1b1b] overflow-hidden shadow-sm sm:rounded-lg border border-yellow-600/40">
                <div class="p-6 text-white">
                    <h3 class="font-semibold text-lg mb-4 text-[#f2c94c]">Edit actor</h3>

                    {{-- actor Form --}}
                    <x-actor-form
                        :action="route('actors.update', $actor)" {{-- routes to the update method in the actorController to then the actor Form --}}
                        :method="'PUT'"
                        :actor="$actor" {{-- passes the actor data to the form to prefill with existing data --}}
                        :musicals="$musicals" {{-- passes the musicals to the actor form for the musicals multi select --}}
                        :actorMusical="$actorMusical" {{-- passes the actor's associated musicals to pre-select in the multi select --}}
                    />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>