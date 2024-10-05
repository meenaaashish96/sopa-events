<?php

namespace App\Exports;

use App\Models\AdvertisementRelease;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportAdvertisementRelease implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AdvertisementRelease::all();
    }
}
