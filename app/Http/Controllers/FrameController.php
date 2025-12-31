<?php

namespace App\Http\Controllers;

use App\Models\Frame;
use App\Models\frame_stoks;
use App\Models\supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

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

        return view('admin.frames_index', compact('frames'));
    }

    public function create()
    {
        $suppliers = supplier::orderBy('nama')->get();
        return view('admin.frames_create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'kode_frame' => 'required|unique:frames,kode_frame',
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
        $suppliers = supplier::orderBy('nama')->get();
        return view('admin.frames_edit', compact('frame', 'suppliers'));
    }

    public function update(Request $request, Frame $frame)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'kode_frame'  => 'required|unique:frames,kode_frame,' . $frame->id,
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
