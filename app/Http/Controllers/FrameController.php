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
                    ->orWhere('nama_frame', 'like', '%' . $request->q . '%')
                    ->orWhere('merk', 'like', '%' . $request->q . '%');
            });
        }

        $frames = $query
            ->orderBy('nama_frame')
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
            'nama_frame' => 'required',
            'merk' => 'nullable|string',
            'warna' => 'nullable|string',
            'bahan' => 'nullable|string',
            'kategori' => 'required|in:bpjs,non_bpjs',
            'harga' => 'nullable|numeric|min:0',
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
            'nama_frame' => 'required',
            'kategori' => 'required|in:bpjs,non_bpjs',
            'harga' => 'nullable|numeric|min:0',
            'aktif' => 'nullable|boolean',
        ]);

        $request['aktif'] = $request->boolean('aktif');

        $frame->update($request->all());

        return redirect()->route('frame.index')
            ->with('success', 'Frame berhasil diperbarui');
    }

    // perbaikan create sti

    /**
     * Riwayat frame
     */
    public function riwayat(Frame $frame)
    {
        // Riwayat dari frame_stok
        $stok = DB::table('frame_stoks')
            ->where('frame_id', $frame->id)
            ->select(
                'tanggal',
                'jenis',
                'jumlah',
                'keterangan',
                DB::raw("'Stok Manual' as sumber")
            );

        // Riwayat keluar dari tabel pasiens (pemakaian frame)
        $rekam = DB::table('pasiens')
            ->where('frame_id', $frame->id)
            ->select(
                DB::raw('tanggal_pengambilan as tanggal'),
                DB::raw("'keluar' as jenis"),
                DB::raw('1 as jumlah'),
                DB::raw("'Digunakan untuk pasien' as keterangan"),
                DB::raw("'Rekam Medis' as sumber")
            );

        // UNION + SORT
        $riwayat = $stok
            ->unionAll($rekam)
            ->orderBy('tanggal', 'desc')
            ->paginate(50);

        return view('admin.frames_riwayat', compact('frame', 'riwayat'));
    }

    public function riwayatAll(Request $request)
    {
        $stok = DB::table('frame_stoks')
            ->join('frames', 'frames.id', '=', 'frame_stoks.frame_id')
            ->select(
                'frame_stoks.tanggal',
                'frames.kode_frame',
                'frames.nama_frame',
                'frame_stoks.jenis',
                'frame_stoks.jumlah',
                'frame_stoks.keterangan',
                DB::raw("'stok' as sumber")
            );

        $rekam = DB::table('pasiens')
            ->join('frames', 'frames.id', '=', 'pasiens.frame_id')
            ->select(
                DB::raw('pasiens.tanggal_pengambilan as tanggal'),
                'frames.kode_frame',
                'frames.nama_frame',
                DB::raw("'keluar' as jenis"),
                DB::raw('1 as jumlah'),
                DB::raw("'Digunakan untuk pasien' as keterangan"),
                DB::raw("'rekam_medis' as sumber")
            );

        $query = DB::query()->fromSub(
            $stok->unionAll($rekam),
            'riwayat'
        );

        // FILTER TANGGAL
        if ($request->filled('from')) {
            $query->whereDate('tanggal', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('tanggal', '<=', $request->to);
        }

        $riwayat = $query
            ->orderBy('tanggal', 'desc')
            ->paginate(20)
            ->withQueryString(); // biar filter ikut pagination

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
        $frames = Frame::aktif()->orderBy('nama_frame')->get();
        return view('admin.framesStok_create', compact('frames'));
    }

    /**
     * Simpan stok massal
     */
    public function storeStok(Request $request)
    {
        $request->validate([
            'frames' => 'required|array|min:1',
            'frames.*.frame_id' => 'required|exists:frames,id',
            'frames.*.jenis' => 'required|in:masuk,keluar',
            'frames.*.jumlah' => 'required|integer|min:1',
            'frames.*.tanggal' => 'required|date',
            'frames.*.keterangan' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {
            foreach ($request->frames as $item) {
                frame_stoks::create([
                    'frame_id' => $item['frame_id'],
                    'jenis' => $item['jenis'],
                    'jumlah' => $item['jumlah'],
                    'keterangan' => $item['keterangan'] ?? null,
                    'tanggal' => $item['tanggal'],
                ]);

                $frame = Frame::findOrFail($item['frame_id']);

                if ($item['jenis'] === 'masuk') {
                    $frame->increment('stok', $item['jumlah']);
                } else {
                    // OPTIONAL: cegah stok minus
                    if ($frame->stok < $item['jumlah']) {
                        throw new \Exception('Stok tidak mencukupi');
                    }
                    $frame->decrement('stok', $item['jumlah']);
                }
            }
        });

        return redirect()->route('frame.index')
            ->with('success', 'Stok frame berhasil ditambahkan');
    }
}
