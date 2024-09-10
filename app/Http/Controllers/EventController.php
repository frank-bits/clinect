<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\Attendee;
use Illuminate\Http\Request;
use App\Http\Resources\TicketResource;
use App\Http\Resources\TicketCollection;

class EventController extends Controller
{
    

    public function index()
    {
 
      $tickets=TicketResource::collection(Ticket::paginate(15));

        return view('events.index', compact('tickets'));
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $event = Event::create($request->all());
        return redirect()->route('events.show', $event);
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $event->update($request->all());
        return redirect()->route('events.show', $event);
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index');
    }
}
