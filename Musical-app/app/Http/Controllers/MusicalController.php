<?php

namespace App\Http\Controllers;

use App\Models\Musical;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
