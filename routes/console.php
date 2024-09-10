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


schedule::job(new GetOnTheBus)->everyMinute();
