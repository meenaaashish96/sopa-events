<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'user_id', 'event_id' ,'title', 'image', 'status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
