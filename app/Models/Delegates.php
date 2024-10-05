<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delegates extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'user_id', 'event_id', 'delegate_reg_id' ,'name', 'image', 'designation', 'status', 'batch_assign', 'dial_code', 'mobile', 'email', 'per_delegate','per_delegate_tax', 'total_delegate', 'type'
    ];

    // type = // free , paid

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function event() {
        return $this->belongsTo(Event::class);
    }

    // public function deletegates() {
    //     return $this->belongsTo(DeletegateRegistation::class);
    // }

    public function deletegateRegistation() {
        return $this->belongsTo(DeletegateRegistation::class, 'delegate_reg_id');
    }

    // Relationship with Scan
    public function scans()
    {
        return $this->hasMany(Scan::class, 'delegate_id');
    }

}
