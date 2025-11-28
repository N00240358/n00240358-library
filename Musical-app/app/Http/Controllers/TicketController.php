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
        $tickets = Ticket::where('user_id', auth()->id())->get(); // Get tickets for the authenticated user
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        if ($ticket->user_id !== auth()->id()) { //auth for owner only
            return redirect()->route('tickets.index')->with('error', 'Access denied.');
        }

        return view('tickets.show', compact('ticket'));
    }
}
