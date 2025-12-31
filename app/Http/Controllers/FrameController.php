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
            'kategori' => 'required|in:bpjs,non_bpjs',
            'harga' => 'nullable|numeric|min:0',
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
            'kategori' => 'required|in:bpjs,non_bpjs',
            'harga' => 'nullable|numeric|min:0',
        ]);

        $frame->update($request->all());

        return redirect()->route('frame.index')
            ->with('success', 'Frame berhasil diperbarui');
    }

    /**
     * Riwayat frame
     */

    public function riwayatAll(Request $request)
    {
        $rekam = DB::table('pasiens')
            ->join('frames', 'frames.id', '=', 'pasiens.frame_id')
            ->whereNotNull('pasiens.tanggal_pengambilan')
            ->select([
                DB::raw('pasiens.tanggal_pengambilan as tanggal'),
                'frames.kode_frame',
                // .....
                DB::raw("'keluar' as jenis"),
                DB::raw('1 as jumlah'),
                DB::raw("'Digunakan untuk pasien' as keterangan"),
                DB::raw("'rekam_medis' as sumber"),
            ]);

        $query = DB::query()
            ->fromSub($rekam, 'riwayat')
            ->when($request->filled('from'), function ($q) use ($request) {
                $q->whereDate('tanggal', '>=', $request->from);
            })
            ->when($request->filled('to'), function ($q) use ($request) {
                $q->whereDate('tanggal', '<=', $request->to);
            });

        $riwayat = $query
            ->orderBy('tanggal', 'desc')
            ->paginate(20)
            ->withQueryString();

        return view('admin.frames_riwayatAll', compact('riwayat'));
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
