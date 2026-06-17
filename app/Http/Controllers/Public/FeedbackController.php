<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
    public function create()
    {
        return view('public.feedback');
    }
    public function store() {}
}
