<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SopnserInquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name' ,'email', 'mobile', 'subject', 'status', 'message'
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function event() {
        return $this->belongsTo(Event::class);
    }
}
