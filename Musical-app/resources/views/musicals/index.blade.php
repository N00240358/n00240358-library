{{-- Alert for successful actions --}}
<x-alert-success>
    {{ session('success') }}
</x-alert-success>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-grey-800 leading-tight">
            {{ __('All Musicals') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-grey-900">
                    <h3 class="font-semibold text-lg mb-4">List of Musicals</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($musicals as $musical)
                            <div class="border p-4 rounded-lg shadow-md">
                                <a href="{{ route('musicals.show', $musical) }}">
                                    <x-musical-card
                                        :title="$musical->title"
                                        :image="$musical->image"
                                    />
                                </a>

                                {{-- Edit and Delete Buttons --}}
                                <div class="mt-4 flex space-x-2">
                                    <a href="{{ route('musicals.edit', $musical) }}" class="text-gray-600 bg-orange-300 hover:bg-orange-700 font-bold py-2 px-4 rounded">
                                        Edit
                                    </a>

                                    <form action="{{ route('musicals.destroy', $musical) }}" method="POST" 
                                        onsubmit="return confirm('Are you sure you want to delete this musical?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-gray-600 font-bold py-2 px-4 rounded">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>