<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioFile;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $files = PortfolioFile::with('portfolio')->latest()->paginate(20);
        return view('admin.gallery.index', compact('files'));
    }

    public function destroy(PortfolioFile $galeri)
    {
        Storage::disk('public')->delete($galeri->file_path);
        $galeri->delete();

        return back()->with('success', 'File berhasil dihapus.');
    }
}
