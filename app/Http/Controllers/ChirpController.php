<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('chirps.index', [
            'chirps' => Chirp::with('user')->latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|min:5|max:255'
        ]);

        auth()->user()->chirps()->create([
            'message' => $request->message
        ]);

        return to_route('chirps.index')->with('status', 'Chirp created successfully!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        /* if(auth()->user()->isNot($chirp->user)){
            return to_route('chirps.index');
        } */
        $this->authorize('update', $chirp);

        return view('chirps.editchirp', [
            'chirp' => $chirp
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
       /*  if(auth()->user()->isNot($chirp->user)){
            return to_route('chirps.index');
        } */
        $this->authorize('update', $chirp);

        $validated = $request->validate([
            'message' => 'required|min:5|max:255'
        ]);

        $chirp->update($validated);
        return to_route('chirps.index')->with('status', 'Chirp updated successfully!!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        $this->authorize('delete', $chirp);
        $chirp->delete();
        return to_route('chirps.index')->with('status', 'Chirp deleted successfully!!');
    }
}
