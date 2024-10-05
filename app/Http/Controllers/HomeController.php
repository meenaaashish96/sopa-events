<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\documnet;
use App\Models\Event as ModelsEvent;
use App\Models\EventSections;
use App\Models\Gallery;
use App\Models\Guests;
use App\Models\Speakers;
use App\Models\Schedule;
use App\Models\Sponsors;
use App\Models\Venues;
use App\Models\WhoShouldAttend;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documnetSchedule = documnet::where('type', 'Schedule')->first();
        $documnetDelegate = documnet::where('type', 'Delegate')->first();
        $documnetFloorPlan = documnet::where('type', 'Floor Plan')->first();
        $documnetAdvertise = documnet::where('type', 'Advertise')->first();
        $documnetExhibit = documnet::where('type', 'Exhibit')->first();

        $event = ModelsEvent::where("status", "1")->first();

        $delegatesprice = getDelegatePrice($event);
        // dd($delegatesprice);

        $venue = Venues::where("status", "1")->where('event_id', $event->id)->first();
        $aboutus = EventSections::where("status", "1")->where("type", "about")->first();
        $whoshouldattend = EventSections::where("status", "1")->where("type", "whoshouldattend")->first();
        $whyshouldattend = EventSections::where("status", "1")->where("type", "whyshouldparticipate")->first();
        $scheduleSection = EventSections::where("status", "1")->where("type", "schedule")->first();
        $speakersSection = EventSections::where("status", "1")->where("type", "speakers")->first();
        $speakerspastSection = EventSections::where("status", "1")->where("type", "speakerspast")->first();
        $registration = EventSections::where("status", "1")->where("type", "registration")->first();
        $guestSection = EventSections::where("status", "1")->where("type", "guests")->first();
        $gallerySection = EventSections::where("status", "1")->where("type", "gallery")->first();
        $sponsorSection = EventSections::where("status", "1")->where("type", "sponsor")->first();
        $attendees = WhoShouldAttend::where("status", "1")->orderBy('order', 'asc')->get();
        
        $spearkers = Speakers::where("status", "1")->get();
        $schedules = Schedule::where("status", "1")->get();
        $soponsers = Sponsors::where("status", "1")->get();

        $soponsercategory = Category::where("status", "1")->with(array('sponsors' => function($query)
            {
                $query->where('status', 1);
            }))->orderBy('order', 'asc')->get();
        $guests = Guests::where("status", "1")->get();
        $galleries = Gallery::get();
        // dd($soponsercategory);
        return view('index')->with(compact('aboutus', 'whoshouldattend', 'whyshouldattend', 'soponsers', 'schedules', 'spearkers', 'galleries', 'event', 'venue', 'guests', 'documnetSchedule', 'documnetDelegate', 'documnetFloorPlan', 'documnetAdvertise', 'documnetExhibit', 'attendees', 'soponsercategory', 'scheduleSection', 'speakersSection', 'speakerspastSection', 'registration', 'guestSection', 'gallerySection', 'sponsorSection'));
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
