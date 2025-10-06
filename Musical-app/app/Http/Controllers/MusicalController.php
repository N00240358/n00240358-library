<?php

namespace App\Http\Controllers;

use App\Models\Musical;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Storage;

class MusicalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $musicals = Musical::all();
        return view('musicals.index', compact('musicals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('musicals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'title' => 'required',
            'description' => 'required|max:500',
            'premiere_date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gij|max:2048',
            'duration' => 'required|integer|min:1|max:600',
            'director' => 'required|alpha|max:100',
        ]);

        // Check if the image is uploaded and handle it
        if ($request->hasFile('image')) {

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/musicals'), $imageName);
        }

        // Create a musical record in the database
        Musical::create([
            'title' => $request->title,
            'description' => $request->description,
            'premiere_date' => $request->premiere_date,
            'image' => $imageName, //Stores image path/URL to database
            'duration' => $request->duration,
            'director' => $request->director
        ]);

        //Redirect to the index page when successful with message
        return to_route('musicals.index')->with('success', 'Musical created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Musical $musical)
    {
        return view('musicals.show')->with('musical', $musical);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Musical $musical)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Musical $musical)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Musical $musical)
    {
        //
    }
}
