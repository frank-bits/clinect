<?php

namespace App\Http\Resources;

use App\Models\Attendee;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TicketCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          'data' => ['id' => $this->id,
            'name' => $this->name,
            'event_id' => $this->event_id,
            'attendee_id' => $this->attendee_id,
            'event' => $this->event,
            'attendee' => $this->attendee->with('preferences'),
            'other_events' => Attendee::where('attendee_id', $this->attendee_id)->events->where('event_id', '!=', $this->event_id)->get(),
            'price' => $this->price,
            'quantity' => $this->quantity,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date, ],

            
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
