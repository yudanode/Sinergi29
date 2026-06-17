<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

class PortofolioController extends Controller
{
    public function index()
    {
        return view('public.portfolio.index');
    }
    public function show($portfolio)
    {
        return view('public.portfolio.show');
    }
}
