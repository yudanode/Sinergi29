<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'location'    => 'required',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after:start_date',
        ]);

        $data = $request->only('title', 'description', 'location', 'start_date', 'end_date');
        $data['user_id'] = auth()->id();

        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('events', 'public');
        }

        Event::create($data);

        return redirect()->route('admin.event.index')
            ->with('success', 'Event berhasil ditambahkan.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'location'    => 'required',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date',
        ]);

        $data = $request->only('title', 'description', 'location', 'start_date', 'end_date');

        if ($request->hasFile('poster')) {
            if ($event->poster) Storage::disk('public')->delete($event->poster);
            $data['poster'] = $request->file('poster')->store('events', 'public');
        }

        $event->update($data);

        return redirect()->route('admin.event.index')
            ->with('success', 'Event berhasil diupdate.');
    }

    public function destroy(Event $event)
    {
        if ($event->poster) Storage::disk('public')->delete($event->poster);
        $event->delete();

        return redirect()->route('admin.event.index')
            ->with('success', 'Event berhasil dihapus.');
    }
}
