<?php

use App\Models\Event;
use App\Models\Ticket;
use App\Models\Attendee;
use App\Models\Preference;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::get('/', function () {


    

    // $response = Http::get('http://127.0.0.1:8000/api/tickets?page=1');
    // $tickets = $response->json();
    // if ($tickets) {
    //     foreach ($tickets['data'] as $ticket) {
    //         Ticket::updateOrCreate(
    //             ['ticket_id' => $ticket['id']],
    //             [
    //                 'name' => $ticket['name'],
    //                 'event_id' => $ticket['id'],
    //                 'attendee_id' => $ticket['attendee_id'],
    //                 'price' => $ticket['price'],
    //                 'quantity' => $ticket['quantity'],
    //                 'start_date' => $ticket['start_date'],
    //                 'end_date' => $ticket['end_date'],
    //             ]
    //         );
    //     }
    // }
    // $response = Http::get('http://127.0.0.1:8000/api/events');

    // $events=$response->json();

    // for($i=0; $i<$events['total']; $i++){ 


    //     if($i>0){
    //         sleep(1);
    //         $response = Http::get('http://127.0.0.1:8000/api/events?page='.$i);
    //         $events=$response->json();

    //         foreach($events['data'] as $event){
    //             Event::updateOrCreate(
    //                 ['event_id' => $event['id']],
    //                 [
    //                     'name' => $event['name'],
    //                     'event_id' => $event['id'],
    //                     'description' => $event['description'],
    //                     'status' => $event['status'],
    //                     'start_date' => $event['start_date'],
    //                     'end_date' => $event['end_date'],
    //                 ]
    //             );
    //         }
    //     }
    // }

});

Route::get('/events', [EventController::class,'index'])->name('events.index');