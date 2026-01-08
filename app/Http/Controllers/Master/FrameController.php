<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Frame;
use App\Models\supplier;
use Illuminate\Http\Request;

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
            ->orderBy('kode_frame')
            ->paginate(50)
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
        $request->validate([
            'supplier_id' => 'required|exists:Suppliers,id',
            'kode_frame' => 'required|unique:Frames,kode_frame',
            'merk' => 'nullable|string',
            'warna' => 'nullable|string',
            'bahan' => 'nullable|string',
        ]);

        Frame::create($request->all());

        return redirect()->route('frame.index')
            ->with('success', 'Frame berhasil ditambahkan');
    }

    public function edit(Frame $frame)
    {
        $suppliers = Supplier::orderBy('nama')->get();
        return view('admin.master.frames_edit', compact('frame', 'suppliers'));
    }

    public function update(Request $request, Frame $frame)
    {
        $request->validate([
            'supplier_id' => 'required|exists:Suppliers,id',
            'kode_frame'  => 'required|unique:Frames,kode_frame,' . $frame->id,
            'merk'        => 'nullable|string|max:100',
            'warna'       => 'nullable|string|max:100',
            'bahan'       => 'nullable|string|max:100',
        ]);


        // return $request;
        $frame->update($request->all());

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
