<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function create()
    {
        return view('public.feedback');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sender_name'  => 'required|min:3',
            'sender_email' => 'required|email',
            'message'      => 'required|min:10',
        ]);

        Feedback::create($request->only('sender_name', 'sender_email', 'message'));

        return back()->with('success', 'Pesan Anda berhasil dikirim! Terima kasih atas masukan Anda.');
    }
}
