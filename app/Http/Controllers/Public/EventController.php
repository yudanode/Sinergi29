<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function index()
    {
        return view('public.events.index');
    }
    public function show($event)
    {
        return view('public.events.show');
    }
}
