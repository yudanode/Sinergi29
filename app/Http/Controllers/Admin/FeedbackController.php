<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
    public function index()
    {
        return view('admin.feedback.index');
    }
    public function destroy($id) {}
}
