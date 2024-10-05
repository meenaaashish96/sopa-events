<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpotRegistrations extends Model
{
    use HasFactory;

  
    protected $fillable = [
        'id', 'user_id', 'event_id', 'name', 'dial_code', 'mobile', 'email', 'designation', 'organization_name', 'GSTIN', 'address', 'city', 'pin_code', 'state', 'deletegate_category', 'amount', 'tax', 'total_amount', 'payment_received', 'payment_date', 'payment_mode', 'UTR_number', 'receipt_number', 'payment_status', 'status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function event() {
        return $this->belongsTo(Event::class);
    }

}
