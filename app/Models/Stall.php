<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stall extends Model
{
    use HasFactory;
    
    // Color
    protected $fillable = [
        'id', 'user_id', 'event_id' ,'name', 'package_type', 'complementary_delegate', 'stall', 'amount', 'amount_tax', 'status', 'color'
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function event() {
        return $this->belongsTo(Event::class);
    }

    public function StallLayoutCell() {
        return $this->hasOne(StallLayoutCells::class);
    }
}
