<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }
    public function create()
    {
        return view('admin.users.create');
    }
    public function store() {}
    public function show($id) {}
    public function edit($id)
    {
        return view('admin.users.edit');
    }
    public function update($id) {}
    public function destroy($id) {}
}
