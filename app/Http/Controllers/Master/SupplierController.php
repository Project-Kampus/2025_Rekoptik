<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $suppliers = Supplier::when($request->q, function ($query) use ($request) {
            $query->where('nama_supplier', 'like', '%' . $request->q . '%')
                ->orWhere('kontak', 'like', '%' . $request->q . '%');
        })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.supplier_index', compact('suppliers'));
    }

    public function create()
    {
        return view('admin.supplier_create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kontak'        => 'required|string|max:50',
            'alamat'        => 'required|string',
        ]);

        supplier::create($validated);

        return redirect()
            ->route('supplier.index')
            ->with('success', 'Supplier berhasil ditambahkan');
    }

    /**
     * Detail supplier
     */
    public function show(supplier $supplier)
    {
        return view('admin.supplier_show', compact('supplier'));
    }

    /**
     * Form edit supplier
     */
    public function edit(supplier $supplier)
    {
        return view('admin.supplier_edit', compact('supplier'));
    }

    /**
     * Update data supplier
     */
    public function update(Request $request, supplier $supplier)
    {
        $validated = $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'kontak'        => 'nullable|string|max:50',
            'alamat'        => 'nullable|string',
        ]);

        $supplier->update($validated);

        return redirect()
            ->route('supplier.index')
            ->with('success', 'Supplier berhasil diperbarui');
    }

    /**
     * Hapus supplier
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()
            ->route('supplier.index')
            ->with('success', 'Supplier berhasil dihapus');
    }
}
