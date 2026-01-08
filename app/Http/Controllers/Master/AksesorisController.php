<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Aksesoris;
use App\Models\Supplier;
use Illuminate\Http\Request;

class AksesorisController extends Controller
{
    public function index(Request $request)
    {
        $aksesoris = Aksesoris::with('supplier')->when($request->q, function ($query) use ($request) {
            $query->where('nama', 'like', '%' . $request->q . '%');
        })
            ->latest()
            ->paginate(20)
            ->withQueryString();


        return view('admin.master.aksesoris_index', compact('aksesoris'));
    }

    public function create()
    {
        $suppliers = Supplier::orderBy('nama')->get();

        return view('admin.master.aksesoris_create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'        => 'required|string|max:255',
            'material'    => 'nullable|string|max:255',
            'keterangan'  => 'nullable|string',
            'supplier_id' => 'nullable|exists:suppliers,id',
        ]);

        Aksesoris::create($validated);

        return redirect()
            ->route('aksesoris.index')
            ->with('success', 'Aksesoris berhasil ditambahkan');
    }

    public function edit(Aksesoris $aksesori)
    {
        $suppliers = Supplier::orderBy('nama')->get();

        return view('admin.master.aksesoris_edit', compact('aksesori', 'suppliers'));
    }

    /**
     * Update data aksesoris
     */
    public function update(Request $request, Aksesoris $aksesori)
    {
        $validated = $request->validate([
            'nama'        => 'required|string|max:255',
            'material'    => 'nullable|string|max:255',
            'keterangan'  => 'nullable|string',
            'supplier_id' => 'nullable|exists:suppliers,id',
        ]);

        $aksesori->update($validated);

        return redirect()
            ->route('aksesoris.index')
            ->with('success', 'Aksesoris berhasil diperbarui');
    }

    /**
     * Hapus aksesoris
     */
    public function destroy(Aksesoris $aksesori)
    {
        $aksesori->delete();

        return redirect()
            ->route('aksesoris.index')
            ->with('success', 'Aksesoris berhasil dihapus');
    }
}
