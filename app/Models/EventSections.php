<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSections extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'user_id', 'event_id' ,'title', 'image', 'type', 'status', 'sub_title', 'short_description', 'description'
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function event() {
        return $this->belongsTo(Event::class);
    }


}
