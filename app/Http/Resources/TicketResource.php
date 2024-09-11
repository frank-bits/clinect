<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array with pagination links.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          'data' =>[ 'id' => $this->id,
            'name' => $this->name,
            'event_id' => $this->event_id,
            'attendee_id' => $this->attendee_id,
            'event' => $this->event,
            'attendee' => $this->attendee->with('preferences'),
            'price' => $this->price,
            'quantity' => $this->quantity,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date, 
          ],
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
