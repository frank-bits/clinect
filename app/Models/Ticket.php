<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;


    protected $guarded = [];

    // Define the relationship between the ticket and the attendee
    public function attendee(): BelongsTo
    {
        return $this->belongsTo(Attendee::class);
    }

    // Define the relationship between the ticket and the event
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
