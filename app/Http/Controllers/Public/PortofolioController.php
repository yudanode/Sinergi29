<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;

class PortofolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::with(['category', 'files', 'likes'])
            ->when(request('category'), fn($q) => $q->where('category_id', request('category')))
            ->latest()->paginate(9);

        $categories = PortfolioCategory::all();

        return view('public.portfolio.index', compact('portfolios', 'categories'));
    }

    public function show($id)
    {
        $portfolio = Portfolio::with(['category', 'files', 'likes'])->findOrFail($id);
        return view('public.portfolio.show', compact('portfolio'));
    }
}
