<?php

namespace App\Http\Controllers;

use App\Models\Musical;
use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Musical $musical)
    {
        // dd($musical);
        $request->validate([
            'title' => 'required|string|max:255',
            'duration' => 'required|integer|min:1|max:60',
            'composer' => 'required|string|max:255',
        ]);

        // $musical->songs()->create([
        //     'title' => $request->input('title'),
        //     'duration' => $request->input('duration'),
        //     'composer' => $request->input('composer')
        // ]);

        $musical->songs()->create($request->only('title', 'duration', 'composer'));

        return redirect()->route('musicals.show', $musical)->with('success', 'Song added successfully.');

        }
    

    /**
     * Display the specified resource.
     */
    public function show(Song $song)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Song $song)
    {
        if (auth()->user()->role !== 'admin'){
            return redirect()->route('musicals.index')->with('error', 'Access denied.');
        }

        return view('songs.edit', compact('song'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Song $song)
    {
        if (auth()->user()->role !== 'admin'){
            return redirect()->route('musicals.index')->with('error', 'Access denied.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'duration' => 'required|integer|min:1|max:60',
            'composer' => 'required|string|max:255',
        ]);

        $song->update($request->only('title', 'duration', 'composer'));

        return redirect()->route('musicals.show', $song->musical_id)->with('success', 'Song updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Song $song)
    {
        //
    }
}
