<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StallLayoutCells extends Model
{
    use HasFactory;

    protected $fillable = [
        'id' ,'call', 'stall_number', 'stall_id', 'layout_id'
    ];


    public function Stall() {
        return $this->belongsTo(Stall::class);
    }

    public function StallLayout() {
        return $this->belongsTo(StallLayouts::class);
    }
}
