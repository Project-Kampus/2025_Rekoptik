<?php

namespace App\Http\Controllers;

use App\Models\Frame;
use App\Models\frame_stoks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrameController extends Controller
{
    /**
     * List semua frame
     */
    public function index()
    {
        $frames = Frame::latest()->get();
        return view('frames.index', compact('frames'));
    }

    /**
     * Form tambah frame
     */
    public function create()
    {
        return view('frames.create');
    }

    /**
     * Simpan frame baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_frame' => 'required|unique:frames,kode_frame',
            'nama_frame' => 'required',
            'kategori' => 'required|in:bpjs,non_bpjs',
            'harga' => 'nullable|numeric|min:0',
            'stok' => 'nullable|integer|min:0',
        ]);

        DB::transaction(function () use ($request) {
            $frame = Frame::create($request->all());

            // Jika stok awal diisi, catat ke histori stok
            if ($request->stok > 0) {
                frame_stoks::create([
                    'frame_id' => $frame->id,
                    'jenis' => 'masuk',
                    'jumlah' => $request->stok,
                    'keterangan' => 'Stok awal',
                    'tanggal' => now(),
                ]);
            }
        });

        return redirect()->route('frames.index')
            ->with('success', 'Frame berhasil ditambahkan');
    }

    /**
     * Form edit frame
     */
    public function edit(Frame $frame)
    {
        return view('frames.edit', compact('frame'));
    }

    /**
     * Update frame
     */
    public function update(Request $request, Frame $frame)
    {
        $request->validate([
            'nama_frame' => 'required',
            'kategori' => 'required|in:bpjs,non_bpjs',
            'harga' => 'nullable|numeric|min:0',
            'aktif' => 'required|boolean',
        ]);

        $frame->update($request->all());

        return redirect()->route('frames.index')
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

    /**
     * ===============================
     * TAMBAH STOK (BANYAK FRAME SEKALIGUS)
     * ===============================
     */

    /**
     * Form tambah stok massal
     */
    public function createStok()
    {
        $frames = Frame::aktif()->get();
        return view('frames.stok.create', compact('frames'));
    }

    /**
     * Simpan stok massal
     */
    public function storeStok(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.frame_id' => 'required|exists:frames,id',
            'items.*.jumlah' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            foreach ($request->items as $item) {

                // Simpan histori stok
                frame_stoks::create([
                    'frame_id' => $item['frame_id'],
                    'jenis' => 'masuk',
                    'jumlah' => $item['jumlah'],
                    'keterangan' => 'Penambahan stok',
                    'tanggal' => now(),
                ]);

                // Update stok di tabel frames
                Frame::where('id', $item['frame_id'])
                    ->increment('stok', $item['jumlah']);
            }
        });

        return redirect()->route('frames.index')
            ->with('success', 'Stok frame berhasil ditambahkan');
    }
}
