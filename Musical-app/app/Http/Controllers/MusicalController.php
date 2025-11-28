<?php

namespace App\Http\Controllers;

use App\Models\Musical;
use App\Models\Actor;
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
        return view('musicals.index', compact('musicals')); // gets all the musicals from the database and put them in a array to pass to the view.
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role !== 'admin') { //auth for admin only
            return redirect()->route('musicals.index')->with('error', 'Access denied.');
        }
            $actors = Actor::all();
            return view('musicals.create', compact('actors')); // when clicked on moves the user to the create view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate input
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:500',
        'premiere_date' => ['required','regex:/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$/'],
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'duration' => 'required|integer|min:1|max:600',
        'director' => 'required|string|max:100',
        'video' => 'nullable|string|max:255',
    ]);

    // Handle image upload
    $imageName = null;

    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/musicals'), $imageName);
    }

    // Build the data array
    $data = [
        'title' => $request->title,
        'description' => $request->description,
        'premiere_date' => $request->premiere_date,
        'image' => $imageName,
        'duration' => $request->duration,
        'director' => $request->director,
        'video' => $request->video,
    ];

    // Create the musical
    $musical = Musical::create($data);

    // Sync actors if provided
    if ($request->has('actors')) {
        $musical->actors()->sync($request->actors);
    }

    return redirect()->route('musicals.index')->with('success', 'Musical created successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(Musical $musical)
    {
        $musical->load('songs', 'actors'); // Load songs and actors related to this musical
        return view('musicals.show', compact('musical'));
        // return view('musicals.show')->with('musical', $musical); //when you click on a musical it takes you to the show view and shows the details of that musical
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Musical $musical)
    {
        if (auth()->user()->role !== 'admin') { //auth for admin only
            return redirect()->route('musicals.index')->with('error', 'Access denied.');
        }
            $actors = Actor::all(); // Get all actors for selection
            $musical->load('actors'); // Load actors related to this musical
            return view('musicals.edit', compact('musical', 'actors')); //brings you to the form with the correct id to edit
    }

        /**
         * Update the specified resource in storage.
         */
    public function update(Request $request, Musical $musical)
    { 
    $data = $request->validate([ //validation for musical update
        'title' => 'required|string|max:100',
        'description' => 'required|string|max:1000',
        'premiere_date' => 'required|string|max:20',
        'duration' => 'required|integer|min:1|max:600',
        'director' => 'required|string|max:100',
        'video' => 'nullable|string|max:255',
    ]);

    $musical->update($data);
    $musical->actors()->sync($request->actors ?? []); // sync actors


    // Handle image if uploaded
    if ($request->hasFile('image')) {
        // checks if a previous image exists
        if ($musical->image && file_exists(public_path($musical->image))) {
            unlink(public_path($musical->image)); //deletes image from the images folder
        }
        // same as the store function
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/musicals'), $imageName);
        $musical->image = $imageName; // store only filename
    }

    // Update other fields
    $musical->title = $request->title;
    $musical->description = $request->description;
    $musical->premiere_date = $request->premiere_date;
    $musical->duration = $request->duration;
    $musical->director = $request->director;
    $musical->video = $request->video;

    $musical->save();

    return redirect()->route('musicals.index')->with('success', 'Musical updated successfully!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Musical $musical)
{
    if (auth()->user()->role !== 'admin') { //auth for admin only
            return redirect()->route('musicals.index')->with('error', 'Access denied.');
    }
    // get url to image folder
    $imagePath = public_path('images/musicals/' . $musical->image);

    // Delete image if it exists in the folder
    if ($musical->image && file_exists($imagePath)) {
        unlink($imagePath);
    }

    // Delete the musical in the database
    $musical->delete();
    // Redirect to index with success message
    return to_route('musicals.index')->with('success', 'Musical deleted successfully!');
    //this ensures that nothing is left when a musical is deleted.
}
}
