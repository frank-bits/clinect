<?php

namespace App\Jobs;

use App\Models\Attendee;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class FetchAttendeesBatch implements ShouldQueue
{
    use Queueable;

    public $page;
    /**
     * Create a new job instance.
     */
    public function __construct($page)
    {   //pass the page number to the job
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
            $response = Http::get('http://127.0.0.1:8000/api/attendees?page=' . $this->page);
            $attendees = $response->json();
            if ($attendees) {
                foreach ($attendees['data'] as $attendee) {
                    Attendee::updateOrCreate(
                        ['attendee_id' => $attendee['id']],
                        [
                            'name' => $attendee['name'],
                            'email' => $attendee['email'],
                        ]
                    );
                }
            }
        }
    }
}
