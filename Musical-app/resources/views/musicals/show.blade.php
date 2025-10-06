<x-app-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-grey-800 leading-tight">
                {{ __('All Musicals')}}
            </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4">Musical Details</h3>
                        <x-musical-details
                        :title="$musical->title"
                        :image="$musical->image"
                        :premiere_date="$musical->premiere_date"
                        :description="$musical->description"
                        />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>