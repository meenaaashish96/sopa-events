<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsors extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'user_id' , 'event_id' , 'category_id' ,'name', 'amount', 'received_amount', 'deliverables', 'image','status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function event() {
        return $this->belongsTo(Event::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

}
