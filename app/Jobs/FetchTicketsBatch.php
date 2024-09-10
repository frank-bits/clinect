<?php

namespace App\Jobs;


use App\Models\Ticket;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class FetchTicketsBatch implements ShouldQueue
{
    use Queueable;
    public $page;
    /**
     * Create a new job instance.
     */
    public function __construct($page)
    {
        $this->page = $page;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->page > 0) {
            $response = Http::get('http://127.0.0.1:8000/api/tickets?page=' . $this->page);
            $tickets = $response->json();
            if ($tickets) {
                foreach ($tickets['data'] as $ticket) {
                 //   Log::info($ticket['']);
                    Ticket::updateOrCreate(
                        ['ticket_id' => $ticket['id']],
                        [
                            'name' => $ticket['name'],
                            'event_id' => $ticket['id'],
                            'attendee_id' => $ticket['attendee_id'],
                            'price' => $ticket['price'],
                            'quantity' => $ticket['quantity'],
                            'start_date' => $ticket['start_date'],
                            'end_date' => $ticket['end_date'],
                        ]
                    );
                }
            }
        }
    }
}
