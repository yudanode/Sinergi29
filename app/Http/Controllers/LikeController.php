<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\Event;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggle(Request $request, $type, $id)
    {
        $models = [
            'post'      => Post::class,
            'event'     => Event::class,
            'portfolio' => Portfolio::class,
        ];

        if (!isset($models[$type])) {
            abort(404);
        }

        $model = $models[$type]::findOrFail($id);

        $existing = Like::where('user_id', auth()->id())
            ->where('likeable_id', $id)
            ->where('likeable_type', $models[$type])
            ->first();

        if ($existing) {
            $existing->delete();
            $liked = false;
        } else {
            $model->likes()->create(['user_id' => auth()->id()]);
            $liked = true;
        }

        return back()->with('liked', $liked);
    }
}
