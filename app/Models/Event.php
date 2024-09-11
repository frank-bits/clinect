<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'name', 'description', 'status', 'start_date', 'end_date', 'created_at', 'updated_at'];
    // Define the relationship between the Event and Ticket models
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    // Define the M:M relationship between the Event and Attendee models
    public function attendees(): BelongsToMany
    {
        return $this->belongsToMany(Attendee::class, 'tickets',  'event_id', 'attendee_id');
    }
}
