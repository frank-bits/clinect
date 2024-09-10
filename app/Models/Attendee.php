<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'attendee_id'];

    public function preferences()
    {
        return $this->hasMany(Preference::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'tickets', 'attendee_id', 'event_id');
    }


}
