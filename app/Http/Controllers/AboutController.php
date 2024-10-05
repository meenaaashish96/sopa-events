<?php

namespace App\Http\Controllers;
use App\Models\Event as ModelsEvent;
use App\Models\Venues;
use App\Models\EventSections;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $event = ModelsEvent::where("status", "1")->first();
        $venue = Venues::where("status", "1")->where('event_id', $event->id)->first();
        $aboutus = EventSections::where("status", "1")->where("type", "about")->first();
        return view('about')->with(compact('aboutus', 'event', 'venue'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
