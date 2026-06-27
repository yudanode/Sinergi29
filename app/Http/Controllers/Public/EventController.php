<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $upcomingEvents = Event::with('likes')
            ->where('start_date', '>=', now())
            ->orderBy('start_date')->get();

        $pastEvents = Event::with('likes')
            ->where('end_date', '<', now())
            ->latest()->take(6)->get();

        return view('public.events.index', compact('upcomingEvents', 'pastEvents'));
    }

    public function show($id)
    {
        $event = Event::with(['likes'])->findOrFail($id);
        return view('public.events.show', compact('event'));
    }
}
