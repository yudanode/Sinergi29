<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\PortfolioFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortofolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::with(['category', 'files'])->latest()->paginate(10);
        return view('admin.portfolio.index', compact('portfolios'));
    }

    public function create()
    {
        $categories = PortfolioCategory::all();
        return view('admin.portfolio.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required']);

        $portfolio = Portfolio::create([
            'user_id'     => auth()->id(),
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'description' => $request->description,
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $ext      = $file->getClientOriginalExtension();
                $fileType = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']) ? 'image' : (($ext == 'pdf') ? 'pdf' : 'document');
                $path     = $file->store('portfolios', 'public');
                PortfolioFile::create([
                    'portfolio_id' => $portfolio->id,
                    'file_path'    => $path,
                    'file_type'    => $fileType,
                ]);
            }
        }

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Portfolio berhasil ditambahkan.');
    }

    public function edit(Portfolio $portfolio)
    {
        $categories = PortfolioCategory::all();
        return view('admin.portfolio.edit', compact('portfolio', 'categories'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $request->validate(['title' => 'required']);

        $portfolio->update([
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'description' => $request->description,
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $ext      = $file->getClientOriginalExtension();
                $fileType = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']) ? 'image' : (($ext == 'pdf') ? 'pdf' : 'document');
                $path     = $file->store('portfolios', 'public');
                PortfolioFile::create([
                    'portfolio_id' => $portfolio->id,
                    'file_path'    => $path,
                    'file_type'    => $fileType,
                ]);
            }
        }

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Portfolio berhasil diupdate.');
    }

    public function destroy(Portfolio $portfolio)
    {
        foreach ($portfolio->files as $file) {
            Storage::disk('public')->delete($file->file_path);
        }
        $portfolio->delete();

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Portfolio berhasil dihapus.');
    }
}
