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
        return view('musicals.index', compact('musicals')); // gets all the musicals from the database and put them in a array to pass to the view.
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('musicals.index')->with('error', 'Access denied.');
        }
        return view('musicals.create'); // when clicked on moves the user to the create view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'title' => 'required|string|max:255', // title is required, is a string with a max length of 255
            'description' => 'required|string|max:500', // description is required, is a string with a max length of 500
            'premiere_date' => ['required','regex:/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$/'], // premiere date is required and regex is for YYYY-MM-DD
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // image is requried, has to be an image and be one of the types given and max size of 2048kb
            'duration' => 'required|integer|min:1|max:600', // duration is required, needs to be between 1 and 600 minutes and an integer
            'director' => 'required|string|max:100', // director is required, max length of 100 and a string
            'video' => 'nullable|string|max:255', // video is not required, max length of 255 and a string
        ]);


        $imagePath = null;
        // Check if the image is uploaded
        if ($request->hasFile('image')) {

            $imageName = time().'.'.$request->image->extension(); // names image using current time
            $request->image->move(public_path('images/musicals'), $imageName); //puts image in the correct folder
            $imagePath = 'images/musicals/' . $imageName; // stores image URL to database
        }

        // Create a musical record in the database put data into the database
        Musical::create([
            'title' => $request->title,
            'description' => $request->description,
            'premiere_date' => $request->premiere_date,
            'image' => $imageName,
            'duration' => $request->duration,
            'director' => $request->director,
            'video' => $request->video
        ]);

        //Redirect to the index page when successful with message
        return to_route('musicals.index')->with('success', 'Musical created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Musical $musical)
    {
        return view('musicals.show')->with('musical', $musical); //when you click on a musical it takes you to the show view and shows the details of that musical
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Musical $musical)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('musicals.index')->with('error', 'Access denied.');
        }
        return view('musicals.edit')->with('musical', $musical); //brings you to the form with the correct id to edit
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Musical $musical)
{ 
    $request->validate([ //validation is the same as store
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:500',
        'premiere_date' => 'required|date',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // is now nullable as if not it requires you to unput the same image again or a different one.
        'duration' => 'required|integer|min:1|max:600',
        'director' => 'required|string|max:100',
        'video' => 'nullable|string|max:255',
    ]);

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
    if (auth()->user()->role !== 'admin') {
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
