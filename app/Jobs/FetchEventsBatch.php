<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Event;

class FetchEventsBatch implements ShouldQueue
{
    use Queueable;

    public $page;

    public $timeout = 30;
    /**
     * Create a new job instance.
     */
    public function __construct($page)
    {   //page number
        $this->page = $page;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->page > 0) {
            // sleep for 2 seconds so we don't overwhelm the API and get blocked
          //  sleep(1);
            $response = Http::get('http://127.0.0.1:8000/api/events?page=' . $this->page);
            $events = $response->json();
            // if there are events, loop through them and update or create them
            if ($events) {
                foreach ($events['data'] as $event) {
                    Event::updateOrCreate(
                        ['event_id' => $event['id']],
                        [
                            'name' => $event['name'],
                            'event_id' => $event['id'],
                            'description' => $event['description'],
                            'status' => $event['status'],
                            'start_date' => $event['start_date'],
                            'end_date' => $event['end_date'],
                        ]
                    );
                }
            }
        }
    }
}
