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
        /* 
            Here we are fetching the data from the API and storing them in the database.
            We are using the page number to fetch the data in batches
            and storing them in the database
            We are also using a sleep function to delay the job by 1 second
            as to not overwhelm the API
            This may be increased or decreased depending on the API rate limit 
            Sometimes these things need careful tuning to avoid getting a 429
        */
        if ($this->page > 0) {
            sleep(1);
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
