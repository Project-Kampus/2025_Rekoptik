<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\lensa;
use App\Models\supplier;
use Illuminate\Http\Request;

class LensaController extends Controller
{

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

        return view('admin.master.lensa_index', compact('lensas'));
    }

    public function create()
    {
        $suppliers = supplier::orderBy('nama')->get();
        return view('admin.master.lensa_create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'nama_lensa' => 'required|string|max:255',
            'kategori'   => 'required|string|max:100',
            'material'   => 'nullable|string|max:100',
            'coating'    => 'nullable|string|max:100',
            'od'    => 'nullable|string|max:100',
            'os'    => 'nullable|string|max:100',
        ]);

        Lensa::create($request->all());

        return redirect()
            ->route('lensa.index')
            ->with('success', 'Data lensa berhasil ditambahkan.');
    }

    public function edit(Lensa $lensa)
    {
        $suppliers = supplier::orderBy('nama')->get();
        return view('admin.master.lensa_edit', compact('lensa', 'suppliers'));
    }

    public function update(Request $request, Lensa $lensa)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'nama_lensa' => 'required|string|max:255',
            'kategori'   => 'required|string|max:100',
            'material'   => 'nullable|string|max:100',
            'coating'    => 'nullable|string|max:100',
            'od'    => 'nullable|string|max:100',
            'os'    => 'nullable|string|max:100',
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
