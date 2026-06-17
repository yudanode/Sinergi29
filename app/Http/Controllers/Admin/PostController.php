<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index');
    }
    public function create()
    {
        return view('admin.posts.create');
    }
    public function store() {}
    public function show($id) {}
    public function edit($id)
    {
        return view('admin.posts.edit');
    }
    public function update($id) {}
    public function destroy($id) {}
}
