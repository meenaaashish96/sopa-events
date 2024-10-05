<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    // Delegate  Exhibitor  Advertiser
    protected $fillable = [
        'id', 'user_id', 'event_id', 'ref_type', 'ref_id', 'UTR_number', 'Cheque_receipt_number', 'payment_status', 'payment_recevied', 'payment_date', 'payment_mode'
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function event() {
        return $this->belongsTo(Event::class);
    }
}
