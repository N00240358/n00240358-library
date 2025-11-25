<x-app-layout>
    <div class="py-12 bg-[#1a1a1a] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#2b1b1b] border border-yellow-600/30 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <h3 class="font-semibold text-lg mb-4 text-[#f2c94c] border-b border-yellow-600/40 pb-2">
                        My Tickets
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($tickets as $ticket)
                            <div class="bg-[#1f1f1f] border border-yellow-700/40 p-5 rounded-xl shadow-md hover:shadow-yellow-600/20 transition transform hover:-translate-y-1 duration-300">
                                
                                {{-- Display the musical associated with the ticket --}}
                                <a href="{{ route('musicals.show', $ticket->musical) }}">
                                    <x-musical-card
                                        :title="$ticket->musical->title"
                                        :image="$ticket->musical->image"
                                        :director="$ticket->musical->director"
                                    />
                                </a>

                                {{-- Ticket details --}}
                                <div class="mt-2 text-gray-300">
                                    <p><strong>Purchased On:</strong> {{ $ticket->created_at->format('d M, Y') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Optional: show message if no tickets --}}
                    @if($tickets->isEmpty())
                        <p class="mt-6 text-gray-400">You have not purchased any tickets yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>