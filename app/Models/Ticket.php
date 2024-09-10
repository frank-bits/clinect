<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;


    protected $guarded= [
        // 'attendee_id', 
        // 'event_id',
        // 'ticket_id',
        // 'price',
        // 'quantity',
        // 'start_date',
        // 'end_date'
    ];

    public function attendee()
    {
        return $this->belongsTo(Attendee::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    
}
