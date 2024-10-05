<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRoomReservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'user_id', 'event_id' ,'hotel_room_id', 'organization_name', 'GSTIN', 'address', 'city', 'pin_code', 'state', 'tel_phone', 'mobile_phone', 'email', 'country', 'delegate_ids', 'per_delegate', 'per_delegate_tax', 'total_delegate', 'room_price', 'room_price_unit', 'grand_total', 'UTR_number', 'Cheque_receipt_number', 'payment_status', 'payment_recevied', 'payment_date', 'payment_mode', 'status'
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

}
