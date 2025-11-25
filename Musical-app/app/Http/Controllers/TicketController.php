<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::where('user_id', auth()->id())->get();
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        if ($ticket->user_id !== auth()->id()) {
            return redirect()->route('tickets.index')->with('error', 'Access denied.');
        }

        return view('tickets.show', compact('ticket'));
    }
}
