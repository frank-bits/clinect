<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class FetchTickets implements ShouldQueue
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
        // Fetch the ticket count from the API
        $response = Http::get('http://127.0.0.1:8000/api/tickets');

        $tickets = $response->json();

        // Loop through the ticket batches and dispatch a job for each batch
        for ($i = 0; $i < $tickets['total']; $i++) {
            if ($i > 0) {
                //Delay the job by 30 seconds as to not overwhelm the API
                FetchTicketsBatch::dispatch($i)
                    ->delay(now()->addSeconds(30));
            }
        }
    }
}
