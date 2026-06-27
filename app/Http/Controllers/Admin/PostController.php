<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = PostCategory::all();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|min:5',
            'content' => 'required',
        ]);

        $data = $request->only('title', 'content', 'category_id', 'status');
        $data['user_id'] = auth()->id();

        if ($request->status == 'published') {
            $data['published_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('posts', 'public');
        }

        Post::create($data);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Post $beritum)
    {
        $categories = PostCategory::all();
        return view('admin.posts.edit', ['post' => $beritum, 'categories' => $categories]);
    }

    public function update(Request $request, Post $beritum)
    {
        $request->validate([
            'title'   => 'required|min:5',
            'content' => 'required',
        ]);

        $data = $request->only('title', 'content', 'category_id', 'status');

        if ($request->status == 'published' && !$beritum->published_at) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            if ($beritum->thumbnail) Storage::disk('public')->delete($beritum->thumbnail);
            $data['thumbnail'] = $request->file('thumbnail')->store('posts', 'public');
        }

        $beritum->update($data);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diupdate.');
    }

    public function destroy(Post $beritum)
    {
        if ($beritum->thumbnail) Storage::disk('public')->delete($beritum->thumbnail);
        $beritum->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }
}
