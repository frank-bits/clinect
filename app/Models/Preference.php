<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    use HasFactory;

    protected $guarded = [];
    // Define the relationship between the Preference and Attendee models
    public function attendee()
    {
        return $this->belongsTo(Attendee::class);
    }
}
