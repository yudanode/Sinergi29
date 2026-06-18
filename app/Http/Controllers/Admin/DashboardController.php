<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Event;
use App\Models\Portfolio;
use App\Models\Comment;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPosts      = Post::count();
        $totalEvents     = Event::count();
        $totalPortfolios = Portfolio::count();
        $totalComments   = Comment::count();

        return view('admin.dashboard', compact(
            'totalPosts',
            'totalEvents',
            'totalPortfolios',
            'totalComments'
        ));
    }
}
