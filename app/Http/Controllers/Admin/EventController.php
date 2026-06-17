<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function index()
    {
        return view('admin.events.index');
    }
    public function create()
    {
        return view('admin.events.create');
    }
    public function store() {}
    public function show($id) {}
    public function edit($id)
    {
        return view('admin.events.edit');
    }
    public function update($id) {}
    public function destroy($id) {}
}
