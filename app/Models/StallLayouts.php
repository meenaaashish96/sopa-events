<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StallLayouts extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'user_id', 'event_id' ,'horizontal_grid', 'vartical_grid', 'disclaimer', 'status'
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function event() {
        return $this->belongsTo(Event::class);
    }

    public function StallLayout() {
        return $this->hasOne(StallLayoutCells::class);
    }
}