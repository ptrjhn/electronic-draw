<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Event;
use App\Prize;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::get()->groupBy(function ($val) {
            return \Carbon\Carbon::parse($val->event_date)->format('m-Y');
        });

        return view('administration.events.index')->with(['events' => $events, 'title' => 'Events']);
    }

    public function view($slug)
    {
        $event = Event::where('slug', $slug)->first();

        if(!$event) return abort(404);

        $players = $event->players()->orderBy('is_selected', 'desc')->get();

        return view('administration.events.details')
                ->with(['event' => $event,
                        'players' => $players,
                        'title' => $event->name]);
    }

    public function viewSpinner($slug)
    {
        $event = Event::where('slug', $slug)->first();

        if(!$event) return abort(404);

        $players = $event->players()->where('is_selected', 0)->get();

        return view('administration.events.spinner')
                ->with(['event' => $event,
                        'players' => $players,
                        'title' => $event->name]);
    }

    public function draw($slug, $prizeSlug)
    {
        $event = Event::where('slug', $slug)->first();

        if(!$event) return abort(404);

    $prize = Prize::where([
        ['slug', $prizeSlug],
        ['event_id', $event->id],

    ])->first();

        if(!$prize) return abort(404);

        return view('administration.events.draw')
                ->with(['event' => $event, 'prize' => $prize]);
        
    }

    public function viewPrizes($slug)
    {
        $event = Event::where('slug', $slug)->first();
        
        return view('administration.events.prizes')
                ->with([
                    'title' => $event->name,
                    'event' => $event,
                    'prizes' => $event->prizes,
                ]);
    }

    public function viewWinners($slug)
    {
        $event = Event::where('slug', $slug)->first();
        
        return view('administration.events.winner')
                ->with([
                    'title' => $event->name,
                    'winners' => $event->winners,
                ]);
    }

}
