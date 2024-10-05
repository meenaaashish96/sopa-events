<?php

namespace App\Http\Controllers;
use App\Models\Event as ModelsEvent;
use App\Models\ExhibitionStallBooking;

use Illuminate\Http\Request;

class ExibihitionBookingKistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $event = ModelsEvent::where("status", "1")->first();
        // Retrieve all relevant exhibition bookings
        $exhibition = ExhibitionStallBooking::where('status', '1')
        ->with('deletegateRegistation')
        ->get();

        // Calculate total sum of stalls and add it to each booking
        $exhibition->transform(function ($booking) {
            $stalls = $booking->stalls;
            $stallNumbers = array_column($stalls, 'stall');
            $totalSum = array_sum($stallNumbers);
            $booking->stall_numbers = $stallNumbers; // Add an attribute to hold the stall numbers
            $booking->total_sum = $totalSum;
            return $booking;
        });

        // Sort the bookings by total_sum
        $exhibition = $exhibition->sort(function ($a, $b) {
            return $a->stall_numbers[0] <=> $b->stall_numbers[0];
        });

        return view('exibihition-booking-list')->with(compact('event', 'exhibition'));
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
