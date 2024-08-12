<?php

namespace App\Http\Controllers;

use App\Http\Resources\PeopleBookResource;
use App\Models\Peoplebook;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PeoplebookController extends Controller
{

    public function index()
    {
        $peoples = Peoplebook::with('user:id,name')->latest()->get();

        return Inertia::render('PeopleBooks/Index', [
            'posts' => PeopleBookResource::collection($peoples)
        ]);
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
        $validated = $request->validate([
            'message' =>['required', 'max:255'],
        ]);
        $request->user()->peoplebooks()->create($validated);

        return back()->with('status', __('Post created!'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Peoplebook $peoplebook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peoplebook $peoplebook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peoplebook $peoplebook)
    {
        
        $this->authorize('update' , $peoplebook);

        $validated = $request->validate([
            'message' =>['required', 'max:255'],
        ]);
        
        $peoplebook->update($validated);

        return back()->with('status', __('Post updated!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peoplebook $peoplebook)
    {
        $this->authorize('delete' , $peoplebook);

        $peoplebook->delete();

        return back()->with('status', __('Post deleted!'));

    }
}
