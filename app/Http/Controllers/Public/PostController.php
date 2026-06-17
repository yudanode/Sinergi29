<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        return view('public.posts.index');
    }
    public function show($slug)
    {
        return view('public.posts.show');
    }
    public function storeComment() {}
    public function destroyComment() {}
}
