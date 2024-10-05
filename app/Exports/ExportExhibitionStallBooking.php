<?php

namespace App\Exports;

use App\Models\ExhibitionStallBooking;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportExhibitionStallBooking implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ExhibitionStallBooking::all();
    }
}
