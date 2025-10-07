<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-grey-800 leading-tight">
            {{ __('Edit Musical') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="maxw-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4">Edit New Musical</h3>

                    {{-- Musical Form --}}
                    <x-musical-form
                        :action="route('musicals.update', $musical)"
                        :method="'PUT'"
                        :musical="$musical"
                    />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
