<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class FetchPreferences implements ShouldQueue
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
        // Fetch the preferences count from the API
        $response = Http::get('http://127.0.0.1:8000/api/preferences');

        $preferences = $response->json();
        // Loop through the preferences and dispatch a new job for each batch
        for ($i = 0; $i < $preferences['total']; $i++) {
            if ($i > 0) {
                // add a delay of 30 seconds before dispatching the next job as to not overwhelm the API
                FetchPreferencesBatch::dispatch($i)
                    ->delay(now()->addSeconds(30));
            }
        }
    }
}
