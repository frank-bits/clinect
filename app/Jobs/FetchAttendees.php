<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class FetchAttendees implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Fetch the attendee count from the API
        $response = Http::get('http://127.0.0.1:8000/api/attendees');

        $attendees = $response->json();

        // Loop through the attendee batches and dispatch a job for each batch
        for ($i = 0; $i < $attendees['total']; $i++) {
            if ($i > 0) {
                //Delay the job by 10 seconds as to not overwhelm the API
                FetchAttendeesBatch::dispatch($i)
                    ->delay(now()->addSeconds(10));
            }
        }
    }
}
