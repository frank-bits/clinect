<?php

use App\Jobs\FetchEvents;
use App\Jobs\FetchTickets;
use App\Jobs\FetchAttendees;
use App\Jobs\FetchPreferences;
use App\Jobs\GetOnTheBus;
use Illuminate\Support\Facades\Bus;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;


/* This job will call each of the endpoints to fetch the data from the API.
 I set it at 5 min arbitrarily although setting it to be more frequent could lead to getting a 429 */
schedule::job(new GetOnTheBus)->everyFiveMinutes();
