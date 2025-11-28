<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Musical;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $actors = Actor::with('musicals')->get();
        return view('actors.index', compact('actors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role !== 'admin') { //auth for admin only
            return redirect()->route('actors.index')->with('error', 'Access denied.');
        }

        $musicals = Musical::all();
        return view('actors.create', compact('musicals'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    if (auth()->user()->role !== 'admin') { //auth for admin only
        return redirect()->route('actors.index')->with('error', 'Access denied.');
    }

    $request->validate([  //validation for actor creation
        'name' => 'required|string|max:255',
        'birthdate' => 'required|date',
        'biography' => 'required|string|max:1000',
        'musicals' => 'array',
    ]);

    $currentTimestamp = Carbon::now();

    $actor = Actor::create([ //creation of actor
        'name' => $request->name,
        'birthdate' => $request->birthdate,
        'biography' => $request->biography,
        'created_at' => $currentTimestamp,
        'updated_at' => $currentTimestamp,
    ]);

    if ($request->has('musicals')) { //attach actor to musicals
        $actor->musicals()->attach($request->musicals);
    }

    return redirect()->route('actors.index')->with('success', 'Actor created successfully!');
}


    /**
     * Display the specified resource.
     */
    public function show(Actor $actor)
    {
        $actor->load('musicals'); // Load musicals this actor is in
        return view('actors.show', compact('actor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Actor $actor)
    {
        if (auth()->user()->role !== 'admin') { //auth for admin only
            return redirect()->route('actors.index')->with('error', 'Access denied.');
        }

        $musicals = Musical::all(); // Get all musicals for selection
        $actorMusical  = $actor->musicals->pluck('id')->toArray(); // Get IDs of musicals the actor is in
        return view('actors.edit', compact('actor', 'musicals', 'actorMusical'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Actor $actor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'biography' => 'required|string|max:1000',
            'musicals' => 'array',
        ]);

        $actor->name = $request->name;
        $actor->birthdate = $request->birthdate;
        $actor->biography = $request->biography;
        $actor->save();

        if ($request->has('musicals')) { //sync musicals
            $actor->musicals()->sync($request->musicals);
        } else {
            $actor->musicals()->detach(); // optional: clear all if none selected
        }


        return redirect()->route('actors.index')->with('success', 'Actor updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Actor $actor)
    {
        if (auth()->user()->role !== 'admin') { //auth for admin only
            return redirect()->route('actors.index')->with('error', 'Access denied.');
        }

        $actor->musicals()->detach(); // Detach relationships
        $actor->delete(); // Delete actor
        return redirect()->route('actors.index')->with('success', 'Actor deleted successfully!');
    }
}