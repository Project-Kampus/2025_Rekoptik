<?php

namespace App\Http\Controllers;

use App\Models\lensa;
use Illuminate\Http\Request;

class LensaController extends Controller
{
    /**
     * Tampilkan daftar lensa
     */
    public function index(Request $request)
    {
        $lensas = Lensa::when($request->q, function ($query) use ($request) {
            $query->where('nama_lensa', 'like', "%{$request->q}%")
                ->orWhere('kategori', 'like', "%{$request->q}%")
                ->orWhere('coating', 'like', "%{$request->q}%");
        })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.lensa_index', compact('lensas'));
    }

    /**
     * Tampilkan form tambah lensa
     */
    public function create()
    {
        return view('admin.lensa_create');
    }

    /**
     * Simpan data lensa baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lensa' => 'required|string|max:255',
            'kategori'   => 'required|string|max:100',
            'material'   => 'nullable|string|max:100',
            'coating'    => 'nullable|string|max:100',
            'harga'      => 'required|numeric|min:0',
        ]);

        Lensa::create($request->all());

        return redirect()
            ->route('lensa.index')
            ->with('success', 'Data lensa berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit lensa
     */
    public function edit(Lensa $lensa)
    {
        return view('admin.lensa_edit', compact('lensa'));
    }

    /**
     * Update data lensa
     */
    public function update(Request $request, Lensa $lensa)
    {
        $request->validate([
            'nama_lensa' => 'required|string|max:255',
            'kategori'   => 'required|string|max:100',
            'material'   => 'nullable|string|max:100',
            'coating'    => 'nullable|string|max:100',
            'harga'      => 'required|numeric|min:0',
        ]);

        $lensa->update($request->all());

        return redirect()
            ->route('lensa.index')
            ->with('success', 'Data lensa berhasil diperbarui.');
    }

    /**
     * Hapus data lensa
     */
    public function destroy(Lensa $lensa)
    {
        $lensa->delete();

        return redirect()
            ->route('lensa.index')
            ->with('success', 'Data lensa berhasil dihapus.');
    }
}
