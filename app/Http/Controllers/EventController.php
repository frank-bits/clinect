<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\Attendee;
use Illuminate\Http\Request;
use App\Http\Resources\TicketResource;
use App\Http\Resources\TicketCollection;
use Illuminate\Contracts\View\View;

class EventController extends Controller
{


    public function index():View
    {
        // Paginate the tickets in a collection
        $tickets = TicketResource::collection(Ticket::paginate(15));
        // Return the paginated tickets
        return view('events.index', compact('tickets'));
    }
}
