<?php

namespace App\Exports;

use App\Models\DeletegateRegistation;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportDeletegateRegistation implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DeletegateRegistation::all();
    }

    public function headings(): array
    {
        return [
            'id', 'user_id', 'event_id', 'organization_name', 'GSTIN', 'address', 'city', 'pin_code', 'state', 'tel_phone', 'mobile_phone', 'email', 'country', 'delegate_ids', 'deletegate_category', 'grand_total', 'room_total', 'room_days', 'total_delegate', 'hotal_name', 'hotal_room_type', 'status', 'room_price', 'room_price_tax', 'room_price_unit', 'checkin', 'checkout', 'room_qty'
        ];
    }
}
