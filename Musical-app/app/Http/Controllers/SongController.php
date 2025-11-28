<?php

namespace App\Http\Controllers;

use App\Models\Musical;
use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    /**
     * Show the form for creating a new song for a musical.
     */
    public function create(Musical $musical)
    {
        if (auth()->user()->role !== 'admin') { //auth for admin only
            return redirect()->route('musicals.index')->with('error', 'Access denied.');
        }

        return view('songs.create', compact('musical')); // Pass the musical to the view
    }

    /**
     * Store a newly created song in storage.
     */
    public function store(Request $request, Musical $musical)
    {
        if (auth()->user()->role !== 'admin') { //auth for admin only
            return redirect()->route('musicals.show', $musical)
                             ->with('error', 'Access denied.');
        }

        // Validate input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'duration' => 'required|numeric|min:0.01|max:60',
            'composer' => 'required|string|max:255',
        ]);

        // Create the song associated with this musical
        $musical->songs()->create($validated);

        // Redirect back to the musical's show page
        return redirect()->route('musicals.show', $musical)
                         ->with('success', 'Song added successfully.');
    }

    /**
     * Show the form for editing a song.
     */
    public function edit(Song $song)
    {
        if (auth()->user()->role !== 'admin') { //auth for admin only
            return redirect()->route('musicals.show', $song->musical)
                             ->with('error', 'Access denied.');
        }

        $musical = $song->musical;
        return view('songs.edit', compact('song', 'musical'));
    }

    /**
     * Update a song.
     */
    public function update(Request $request, Song $song)
    {
        if (auth()->user()->role !== 'admin') { //auth for admin only
            return redirect()->route('musicals.show', $song->musical)
                             ->with('error', 'Access denied.');
        }

        $validated = $request->validate([ // Validate input
            'title' => 'required|string|max:255',
            'duration' => 'required|numeric|min:0.01|max:60',
            'composer' => 'required|string|max:255',
        ]);

        $song->update($validated);

        return redirect()->route('musicals.show', $song->musical)
                         ->with('success', 'Song updated successfully.');
    }

    /**
     * Remove a song.
     */
    public function destroy(Song $song)
    {
        $musical = $song->musical;

        if (auth()->user()->role !== 'admin') { //auth for admin only
            return redirect()->route('musicals.show', $musical)
                             ->with('error', 'Access denied.');
        }

        $song->delete();

        return redirect()->route('musicals.show', $musical)
                         ->with('success', 'Song deleted successfully.');
    }
}
