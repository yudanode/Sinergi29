<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Event;

class HomeController extends Controller
{
    public function index()
    {
        $latestPosts   = Post::published()->with('category')->latest()->take(3)->get();
        $upcomingEvents = Event::where('start_date', '>=', now())->orderBy('start_date')->take(3)->get();

        return view('public.home', compact('latestPosts', 'upcomingEvents'));
    }
}
