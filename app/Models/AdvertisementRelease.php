<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertisementRelease extends Model
{
    use HasFactory;
        // New // 'id', 'user_id', 'event_id', 'delegate_reg_id', 'status', 'advertisement_id', 'file', 'amount', 'tax', advertisement_total,  'grand_total'
    protected $fillable = [
        'id', 'user_id', 'event_id' , 'delegate_reg_id', 'status', 'advertisement_id', 'file', 'amount', 'tax', 'advertisement_total',  'grand_total'
        
        
        // 'hotel_room_id', 'organization_name', 'GSTIN', 'address', 'city', 'pin_code', 'state', 'tel_phone', 'mobile_phone', 'email', 'country', 'delegate_ids', 'per_delegate', 'per_delegate_tax', 'total_delegate', 'hotal_name', 'hotal_room_type', 'status', 'room_price', 'room_price_tax', 'room_price_unit', 'checkin', 'checkout', 'room_qty'
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function event() {
        return $this->belongsTo(Event::class);
    }

    public function advertisement() {
        return $this->belongsTo(Advertisement::class);
    }

    public function deletegateRegistation() {
        return $this->belongsTo(DeletegateRegistation::class, 'delegate_reg_id');
    }

}
