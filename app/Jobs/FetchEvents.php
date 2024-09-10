<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Event;
class FetchEvents implements ShouldQueue
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
        // get the events from the API
        $response = Http::get('http://127.0.0.1:8000/api/events');

        $events=$response->json();
       // loop through the events and dispatch a new job for each batch
        for($i=0; $i<$events['total']; $i++){ 
            if($i>0){
                // add a delay of 30 seconds before dispatching the next job as to not overwhelm the API
                FetchEventsBatch::dispatch($i)
                ->delay(now()->addSeconds(30));
            }
        }
}
        
    
}
