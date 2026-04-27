<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Lensa;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            ->paginate(20)
            ->withQueryString();

        return view('admin.master.lensa_index', compact('lensas'));
    }

    public function create()
    {
        $suppliers = Supplier::orderBy('nama')->get();
        return view('admin.master.lensa_create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'nama_lensa' => 'required|string|max:255',
            'kategori'   => 'required|string|max:100',
            'material'   => 'nullable|string|max:100',
            'coating'    => 'nullable|string|max:100',
            'od'    => 'nullable|string|max:100',
            'os'    => 'nullable|string|max:100',
            'harga'      => 'required|numeric|min:0',
            'modal'      => 'nullable|numeric|min:0',
        ]);

        // jika bukan super admin
        if (!Auth::user()->hasRole('superadmin')) {
            unset($validated['modal']);
        }

        Lensa::create($validated);

        return redirect()
            ->route('lensa.index')
            ->with('success', 'Data lensa berhasil ditambahkan.');
    }

    public function edit(Lensa $lensa)
    {
        $suppliers = Supplier::orderBy('nama')->get();
        return view('admin.master.lensa_create', compact('lensa', 'suppliers'));
    }

    public function update(Request $request, Lensa $lensa)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'nama_lensa' => 'required|string|max:255',
            'kategori'   => 'required|string|max:100',
            'material'   => 'nullable|string|max:100',
            'coating'    => 'nullable|string|max:100',
            'od'    => 'nullable|string|max:100',
            'os'    => 'nullable|string|max:100',
            'harga'      => 'required|numeric|min:0',
            'modal'      => 'nullable|numeric|min:0',
        ]);

        // jika bukan super admin
        if (!Auth::user()->hasRole('superadmin')) {
            unset($validated['modal']);
        }

        $lensa->update($validated);

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
