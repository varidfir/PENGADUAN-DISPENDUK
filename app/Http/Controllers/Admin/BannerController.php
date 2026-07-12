<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->get();

        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $gambar = $request->file('gambar')
                          ->store('banners', 'public');

        Banner::create([
            'judul' => $request->judul,
            'gambar' => $gambar,
            'is_active' => true
        ]);

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner berhasil ditambahkan');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        if ($request->hasFile('gambar')) {

            Storage::disk('public')
                ->delete($banner->gambar);

            $banner->gambar = $request->file('gambar')
                                      ->store('banners', 'public');
        }

        $banner->judul = $request->judul;

        $banner->save();

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner berhasil diperbarui');
    }

    public function destroy(Banner $banner)
    {
        Storage::disk('public')->delete($banner->gambar);

        $banner->delete();

        return back()->with(
            'success',
            'Banner berhasil dihapus'
        );
    }

    public function toggle(Banner $banner)
    {
        $banner->update([
            'is_active' => !$banner->is_active
        ]);

        return back();
    }
}