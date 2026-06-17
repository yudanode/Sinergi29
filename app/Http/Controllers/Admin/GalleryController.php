<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function index()
    {
        return view('admin.gallery.index');
    }
    public function create()
    {
        return view('admin.gallery.create');
    }
    public function store() {}
    public function show($id) {}
    public function edit($id)
    {
        return view('admin.gallery.edit');
    }
    public function update($id) {}
    public function destroy($id) {}
}
