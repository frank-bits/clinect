<?php

use App\Models\Event;
use App\Models\Ticket;
use App\Models\Attendee;
use App\Models\Preference;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;


Route::get('/events', [EventController::class,'index'])->name('events.index');
Route::get('/', [EventController::class,'index'])->name('events.index');