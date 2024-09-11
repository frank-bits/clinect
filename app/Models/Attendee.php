<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Attendee extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'attendee_id'];

    // Define the 1:1 relationship between the Attendee and Preference models
    public function preferences(): HasOne
    {
        return $this->hasOne(Preference::class);
    }
    // Define the 1:M relationship between the Attendee and Ticket models
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
    // Define the M:M relationship between the Attendee and Event models
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'tickets', 'attendee_id', 'event_id');
    }
}
