<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExhibitionStallBooking extends Model
{
    use HasFactory;

    // New // 'id', 'user_id', 'event_id', 'delegate_reg_id', 'status', 'stalls', 'amount', 'tax', 'stall_total', 'grand_total'
    protected $fillable = [
       'id', 'user_id', 'event_id', 'delegate_reg_id', 'status', 'stalls', 'amount', 'tax', 'stall_total', 'grand_total'
    ];

    // ['Guest', 'Speaker', 'Sponsors', 'Exhibitor', 'Advertiser', 'Media_Press']

    protected $casts = [
        'stalls' => 'json'
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
