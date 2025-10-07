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
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'premiere_date' => ['required','regex:/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$/'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration' => 'required|integer|min:1|max:600',
            'director' => 'required|string|max:100',
        ]);


        $imagePath = null;
        // Check if the image is uploaded and handle it
        if ($request->hasFile('image')) {

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/musicals'), $imageName);
            $imagePath = 'images/musicals/' . $imageName; // path relative to public
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
        return view('musicals.edit')->with('musical', $musical);
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Musical $musical)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:500',
        'premiere_date' => 'required|date',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // <- nullable now
        'duration' => 'required|integer|min:1|max:600',
        'director' => 'required|string|max:100',
    ]);

    // Handle image if uploaded
    if ($request->hasFile('image')) {
        // Delete old image if it exists
        if ($musical->image && file_exists(public_path($musical->image))) {
            unlink(public_path($musical->image));
        }

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

    $musical->save();

    return redirect()->route('musicals.index')->with('success', 'Musical updated successfully!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Musical $musical)
{
    // Build full path to the image
    $imagePath = public_path('images/musicals/' . $musical->image);

    // Delete associated image if it exists
    if ($musical->image && file_exists($imagePath)) {
        unlink($imagePath);
    }

    // Delete the musical record
    $musical->delete();

    return to_route('musicals.index')->with('success', 'Musical deleted successfully!');
}
}
