<?php

namespace App\Jobs;

use App\Jobs\FetchEvents;
use App\Jobs\FetchTickets;
use App\Jobs\FetchAttendees;
use App\Jobs\FetchPreferences;
use Illuminate\Support\Facades\Bus;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GetOnTheBus implements ShouldQueue
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
        // spread out the jobs to avoid overwhelming the api
    //     FetchTickets::dispatch()
    //     ->delay(now()->addSeconds(4));

    //    FetchEvents::dispatch()
    //     ->delay(now()->addSeconds(30));

  
    //     FetchAttendees::dispatch()
    //     ->delay(now()->addSeconds(50));

        FetchPreferences::dispatch()
        ->delay(now()->addSeconds(2));
    }
}
