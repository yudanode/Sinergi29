<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PortofolioController extends Controller
{
    public function index()
    {
        return view('admin.portfolio.index');
    }
    public function create()
    {
        return view('admin.portfolio.create');
    }
    public function store() {}
    public function show($id) {}
    public function edit($id)
    {
        return view('admin.portfolio.edit');
    }
    public function update($id) {}
    public function destroy($id) {}
}
