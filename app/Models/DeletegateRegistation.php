<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeletegateRegistation extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'id', 'user_id', 'event_id', 'organization_name', 'GSTIN', 'address', 'city', 'pin_code', 'state', 'tel_phone', 'mobile_phone', 'email', 'country', 'delegate_ids', 'deletegate_category', 'grand_total', 'room_total', 'room_days', 'total_delegate', 'hotal_name', 'hotal_room_type', 'status', 'room_price', 'room_price_tax', 'room_price_unit', 'checkin', 'checkout', 'room_qty'
    ];

    protected $casts = [
        'delegate_ids' => 'json'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function event() {
        return $this->belongsTo(Event::class);
    }

    public function advertisementRelease() {
        return $this->hasOne(AdvertisementRelease::class, 'id');
    }

    public function exhibitionStallBooking() {
        return $this->hasOne(ExhibitionStallBooking::class, 'id');
    }

    public function delegates() {
        return $this->hasOne(Delegates::class);
    }
}
