<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ComentController extends Controller
{
    public function index()
    {
        return view('admin.comments.index');
    }
    public function destroy($id) {}
}
