<?php

namespace App\Http\Controllers;

use App\Models\Frame;
use App\Models\frame_stoks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

class FrameController extends Controller
{
    public function index(Request $request)
    {
        $query = Frame::query();

        // Pencarian
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('kode_frame', 'like', '%' . $request->q . '%')
                    ->orWhere('merk', 'like', '%' . $request->q . '%');
            });
        }

        $frames = $query
            ->orderBy('kode_frame')
            ->paginate(50)
            ->withQueryString(); // supaya pagination tidak hilang query search

        return view('admin.frames_index', compact('frames'));
    }


    /**
     * Form tambah frame
     */
    public function create()
    {
        return view('admin.frames_create');
    }

    /**
     * Simpan frame baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_frame' => 'required|unique:frames,kode_frame',
            'merk' => 'nullable|string',
            'warna' => 'nullable|string',
            'bahan' => 'nullable|string',
        ]);

        $frame = Frame::create($request->all());

        return redirect()->route('frame.index')
            ->with('success', 'Frame berhasil ditambahkan');
    }

    /**
     * Form edit frame
     */
    public function edit(Frame $frame)
    {
        return view('admin.frames_edit', compact('frame'));
    }

    /**
     * Update frame
     */
    public function update(Request $request, Frame $frame)
    {
        $request->validate([
            'kode_frame' => 'required|unique:frames,kode_frame',
            'merk' => 'nullable|string',
            'warna' => 'nullable|string',
            'bahan' => 'nullable|string',
        ]);

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
