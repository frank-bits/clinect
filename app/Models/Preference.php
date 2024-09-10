<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function attendee()
    {
        return $this->belongsTo(Attendee::class);
    }

    // public function event()
    // {
    //     return $this->belongsTo(Event::class);
    // }

}
