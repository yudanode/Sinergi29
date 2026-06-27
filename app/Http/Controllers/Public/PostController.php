<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::published()
            ->with(['category', 'likes', 'comments'])
            ->when(request('category'), fn($q) => $q->where('category_id', request('category')))
            ->when(request('search'), fn($q) => $q->where('title', 'like', '%' . request('search') . '%'))
            ->latest('published_at')
            ->paginate(8);

        $categories   = PostCategory::all();
        $popularPosts = Post::published()->with('likes')->get()
            ->sortByDesc(fn($p) => $p->likes->count())->take(5);

        return view('public.posts.index', compact('posts', 'categories', 'popularPosts'));
    }

    public function show($slug)
    {
        $post = Post::published()->with(['user', 'category', 'likes', 'comments.user'])
            ->where('slug', $slug)->firstOrFail();

        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->where('category_id', $post->category_id)
            ->latest()->take(4)->get();

        return view('public.posts.show', compact('post', 'relatedPosts'));
    }

    public function storeComment(Request $request, $postId)
    {
        $request->validate(['comment_text' => 'required|min:3']);

        Comment::create([
            'post_id'      => $postId,
            'user_id'      => auth()->id(),
            'comment_text' => $request->comment_text,
        ]);

        return back()->with('success', 'Komentar berhasil dikirim.');
    }

    public function destroyComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        if ($comment->user_id === auth()->id()) {
            $comment->delete();
        }
        return back()->with('success', 'Komentar dihapus.');
    }
}
