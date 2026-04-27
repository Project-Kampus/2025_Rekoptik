<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Aksesoris;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
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
            'supplier_id' => 'nullable|exists:suppliers,id',
            'material'    => 'nullable|string|max:255',
            'harga'       => 'required|numeric|min:0',
            'modal'       => 'nullable|numeric|min:0',
            'keterangan'  => 'nullable|string',
        ]);

        // jika bukan super admin
        if (!Auth::user()->hasRole('superadmin')) {
            unset($validated['modal']);
        }

        Aksesoris::create($validated);

        return redirect()
            ->route('aksesoris.index')
            ->with('success', 'Aksesoris berhasil ditambahkan');
    }

    public function edit(Aksesoris $aksesoris)
    {
        $suppliers = Supplier::orderBy('nama')->get();

        return view('admin.master.aksesoris_create', compact('aksesoris', 'suppliers'));
    }

    /**
     * Update data aksesoris
     */
    public function update(Request $request, Aksesoris $aksesoris)
    {
        $validated = $request->validate([
            'nama'        => 'required|string|max:255',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'material'    => 'nullable|string|max:255',
            'harga'       => 'required|numeric|min:0',
            'modal'       => 'nullable|numeric|min:0',
            'keterangan'  => 'nullable|string',
        ]);

        // jika bukan super admin
        if (!Auth::user()->hasRole('superadmin')) {
            unset($validated['modal']);
        }

        $aksesoris->update($validated);

        return redirect()
            ->route('aksesoris.index')
            ->with('success', 'Aksesoris berhasil diperbarui');
    }

    /**
     * Hapus aksesoris
     */
    public function destroy(Aksesoris $aksesoris)
    {
        $aksesoris->delete();

        return redirect()
            ->route('aksesoris.index')
            ->with('success', 'Aksesoris berhasil dihapus');
    }
}
