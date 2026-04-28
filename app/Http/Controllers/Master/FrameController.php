<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Frame;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrameController extends Controller
{
    public function index(Request $request)
    {
        $query = Frame::query();

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('kode_frame', 'like', '%' . $request->q . '%')
                    ->orWhere('merk', 'like', '%' . $request->q . '%');
            });
        }

        $frames = $query
            // ->orderBy('kode_frame')
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.master.frames_index', compact('frames'));
    }

    public function create()
    {
        $suppliers = Supplier::orderBy('nama')->get();
        return view('admin.master.frames_create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'kode_frame' => 'required|unique:frames,kode_frame',
            'merk' => 'nullable|string',
            'warna' => 'nullable|string',
            'bahan' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'modal' => 'nullable|numeric|min:0',
        ]);

        // jika bukan super admin
        if (!Auth::user()->hasRole('superadmin')) {
            unset($validated['modal']);
        }

        Frame::create($validated);

        return redirect()->route('frame.index')
            ->with('success', 'Frame berhasil ditambahkan');
    }

    public function edit(Frame $frame)
    {
        $suppliers = Supplier::orderBy('nama')->get();
        return view('admin.master.frames_create', compact('frame', 'suppliers'));
    }

    public function update(Request $request, Frame $frame)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'kode_frame'  => 'required|unique:frames,kode_frame,' . $frame->id,
            'merk'        => 'nullable|string|max:100',
            'warna'       => 'nullable|string|max:100',
            'bahan'       => 'nullable|string|max:100',
            'harga'       => 'required|numeric|min:0',
            'modal'       => 'required|numeric|min:0',
        ]);

        // jika bukan super admin
        if (!Auth::user()->hasRole('superadmin')) {
            unset($validated['modal']);
        }

        $frame->update($validated);

        return redirect()->route('frame.index')
            ->with('success', 'Frame berhasil diperbarui');
    }

    /**
     * Hapus frame
     */
    public function destroy(Frame $frame)
    {
        $frame->delete();

        return back()->with('success', 'Frame berhasil dihapus');
    }
}
