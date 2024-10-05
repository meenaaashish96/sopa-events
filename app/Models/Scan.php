<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scan extends Model
{
    use HasFactory;

    protected $fillable = ['delegate_id', 'stall', 'scanned_at'];

    // Define relationship to Delegate
    public function delegate()
    {
        return $this->belongsTo(Delegate::class, 'delegate_id');
    }
}
