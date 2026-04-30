<?php

namespace App\Http\Controllers\RekamMedis;

use App\Http\Controllers\Controller;
use App\Models\Aksesoris;
use App\Models\Document;
use App\Models\Frame;
use App\Models\Lensa;
use App\Models\RmDokument;
use App\Models\RmPasien;
use App\Models\RmPembayaran;
use App\Models\RmPemeriksaan;
use App\Models\RmPesanan;
use App\Models\Pengaturan;
use App\Models\RmResep;
use App\Models\RmPengambilan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class DataMedisController extends Controller
{
    /**
     * Tampilkan daftar data medis dengan filter pencarian, kategori, status, dan tanggal
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $kategori = $request->query('kategori');
        $status = $request->query('status');
        $tanggal_awal = $request->query('tanggal_awal');
        $tanggal_akhir = $request->query('tanggal_akhir');

        $query = RmPemeriksaan::with('pasien', 'pesanan.pembayarans', 'resep');

        if ($search) {
            $query->whereHas('pasien', function ($q) use ($search) {
                $q->where('nama_pasien', 'like', "%{$search}%")
                    ->orWhere('no_kartu', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })->orWhere('diagnosa', 'like', "%{$search}%");
        }

        // Filter kategori
        if ($kategori) {
            $query->whereHas('pasien', function ($q) use ($kategori) {
                $q->where('kategori', $kategori);
            });
        }

        // Filter status pesanan
        if ($status) {
            $query->whereHas('pesanan', function ($q) use ($status) {
                $q->where('status', $status);
            });
        }

        // Filter tanggal
        if ($tanggal_awal && $tanggal_akhir) {
            $query->whereHas('pesanan', function ($q) use ($tanggal_awal, $tanggal_akhir) {
                $q->whereBetween('created_at', [$tanggal_awal, $tanggal_akhir . ' 23:59:59']);
            });
        } elseif ($tanggal_awal) {
            $query->whereHas('pesanan', function ($q) use ($tanggal_awal) {
                $q->whereDate('created_at', '>=', $tanggal_awal);
            });
        } elseif ($tanggal_akhir) {
            $query->whereHas('pesanan', function ($q) use ($tanggal_akhir) {
                $q->whereDate('created_at', '<=', $tanggal_akhir);
            });
        }

        $data = $query->latest()->paginate(20);

        // Buat ringkasan filter
        $filterSummary = [];
        if ($search) {
            $filterSummary[] = "Pencarian: <strong>{$search}</strong>";
        }
        if ($kategori) {
            $filterSummary[] = "Kategori: <strong>" . ucfirst($kategori) . "</strong>";
        }
        if ($status) {
            $filterSummary[] = "Status: <strong>" . ucfirst($status) . "</strong>";
        }
        if ($tanggal_awal && $tanggal_akhir) {
            $filterSummary[] = "Tanggal: <strong>" . date('d/m/Y', strtotime($tanggal_awal)) . " - " . date('d/m/Y', strtotime($tanggal_akhir)) . "</strong>";
        }

        return view('admin.rekammedis.datamedis_index', compact('data', 'search', 'kategori', 'status', 'tanggal_awal', 'tanggal_akhir', 'filterSummary'));
    }

    /**
     * Tampilkan detail data medis beserta riwayat pemeriksaan, pesanan, dan pembayaran
     */
    public function show(RmPemeriksaan $RmPemeriksaan)
    {
        $RmPemeriksaan->load(
            'pasien',
            'resep',
            'pesanan.frame',
            'pesanan.lensa',
            'pesanan.aksesoris',
            'pesanan.pembayarans',
            'pesanan.pengambilan',
            'dokumens.dokumen'
        );

        $uploadedDokumens = $RmPemeriksaan->dokumens->keyBy('dokumens_id');

        $allDokumens = Document::where('kategori', $RmPemeriksaan->pasien->kategori)->get();

        return view('admin.rekammedis.datamedis_show', compact('RmPemeriksaan', 'uploadedDokumens', 'allDokumens'));
    }

    /**
     * Tampilkan form untuk mengedit data medis pemeriksaan
     */
    public function edit(RmPemeriksaan $RmPemeriksaan)
    {
        $RmPemeriksaan->load('pasien', 'resep', 'pesanan');
        $frames = Frame::all();
        $lensas = Lensa::all();
        $aksesoris = Aksesoris::all();

        return view('admin.rekammedis.datamedis_edit', compact('RmPemeriksaan', 'frames', 'lensas', 'aksesoris'));
    }

    /**
     * Perbarui data medis pemeriksaan, resep, dan pesanan kacamata
     */
    public function update(Request $request, RmPemeriksaan $RmPemeriksaan)
    {
        $validated = $request->validate([
            'no_sep' => 'required|string',
            'diagnosa' => 'required|string',

            'keluhan_utama' => 'required|string',
            'riwayat_penyakit' => 'required|string',
            'penyakit_sekarang' => 'required|string',
            'penyakit_keluarga' => 'required|string',
            'kebiasaan' => 'required|string',
            'pengobatan' => 'required|string',

            'resep_dari' => 'required|string',
            'resep_tanggal' => 'required|date',

            'resep.kanan.sph' => 'numeric|required',
            'resep.kanan.cyl' => 'numeric|required',
            'resep.kanan.axis' => 'numeric|required',
            'resep.kanan.add' => 'numeric|required',
            'resep.kanan.pd' => 'numeric|required',

            'resep.kiri.sph' => 'numeric|required',
            'resep.kiri.cyl' => 'numeric|required',
            'resep.kiri.axis' => 'numeric|required',
            'resep.kiri.add' => 'numeric|required',
            'resep.kiri.pd' => 'numeric|required',

            'frame_id' => 'required|exists:frames,id',
            'lensa_id' => 'required|exists:lensas,id',
            'aksesoris_id' => 'nullable|array',
            'aksesoris_id.*' => 'exists:aksesoris,id',
            'biaya_kacamata' => 'required|numeric',
            'tanggal_dipesan' => 'required|date',
            'tanggal_pengambilan' => 'required|date',
        ]);

        // Update pemeriksaan
        $RmPemeriksaan->update([
            'no_sep' => $validated['no_sep'],
            'keluhan_utama' => $validated['keluhan_utama'],
            'riwayat_penyakit' => $validated['riwayat_penyakit'],
            'penyakit_sekarang' => $validated['penyakit_sekarang'],
            'penyakit_keluarga' => $validated['penyakit_keluarga'],
            'kebiasaan' => $validated['kebiasaan'],
            'pengobatan' => $validated['pengobatan'],
            'diagnosa' => $validated['diagnosa']
        ]);

        // Update resep
        $RmPemeriksaan->resep->update([
            'resep_dari' => $validated['resep_dari'],
            'tanggal' => $validated['resep_tanggal'],

            'od_sferis' => $validated['resep']['kanan']['sph'],
            'od_silindris' => $validated['resep']['kanan']['cyl'],
            'od_axis' => $validated['resep']['kanan']['axis'],
            'od_add_lensa' => $validated['resep']['kanan']['add'],
            'pd_od' => $validated['resep']['kanan']['pd'],

            'os_sferis' => $validated['resep']['kiri']['sph'],
            'os_silindris' => $validated['resep']['kiri']['cyl'],
            'os_axis' => $validated['resep']['kiri']['axis'],
            'os_add_lensa' => $validated['resep']['kiri']['add'],
            'pd_os' => $validated['resep']['kiri']['pd'],
        ]);

        // Update pesanan
        $RmPemeriksaan->pesanan->update([
            'frame_id' => $validated['frame_id'],
            'lensa_id' => $validated['lensa_id'],
            'biaya_kacamata' => $validated['biaya_kacamata'],
            'tanggal_dipesan' => $validated['tanggal_dipesan'],
            'tanggal_pengambilan' => $validated['tanggal_pengambilan'],
        ]);

        // Update aksesoris
        $aksesorisIds = $validated['aksesoris_id'] ?? [];
        $RmPemeriksaan->pesanan->aksesoris()->sync($aksesorisIds);

        return redirect()
            ->route('datamedis.show', [$RmPemeriksaan])
            ->with('success', 'Data medis berhasil diperbarui');
    }

    /**
     * Simpan dokumen pendukung untuk pemeriksaan tertentu
     */
    public function storeDokumnet(Request $request, RmPemeriksaan $RmPemeriksaan)
    {
        $validated = $request->validate([
            'dokumen_id' => 'required|exists:dokumens,id',
            'file'       => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $dokumenFile = $request->file('file')->store('dokumen_pendukung', 'public');
        RmDokument::create([
            'dokumens_id'    => $validated['dokumen_id'],
            'pemeriksaan_id' => $RmPemeriksaan->id,
            'url'      => $dokumenFile,
        ]);
        return redirect()
            ->route('datamedis.show', [$RmPemeriksaan])
            ->with('success', 'Dokumen pendukung berhasil diunggah');
    }

    /**
     * Simpan data pembayaran untuk pesanan kacamata
     */
    public function storePembayaran(Request $request, RmPemeriksaan $RmPemeriksaan)
    {
        $validated = $request->validate([
            'tanggal_bayar' => ['required', 'date'],
            'metode' => [
                'required',
                Rule::in([
                    'tunai',
                    'non_tunai',
                ]),
            ],
            'kategori' => [
                'required',
                Rule::in([
                    'bpjs',
                    'asuransi',
                    'dp',
                    'lunas'
                ]),
            ],
            'jumlah' => ['required', 'numeric', 'min:0'],
        ]);

        RmPembayaran::create([
            'pesanan_id' => $RmPemeriksaan->pesanan->id,
            'metode' => $validated['metode'],
            'kategori' => $validated['kategori'],
            'jumlah' => $validated['jumlah'],
            'tanggal_bayar' => $validated['tanggal_bayar'],
        ]);

        return redirect()
            ->route('datamedis.show', [$RmPemeriksaan])
            ->with('success', 'Pembayaran berhasil dicatat');
    }

    /**
     * Hapus data pembayaran dari database
     */
    public function destroyPembayaran(RmPembayaran $RmPembayaran)
    {
        $RmPembayaran->delete();
        return redirect()
            ->route('datamedis.show', [$RmPembayaran->pesanan->pemeriksaan])
            ->with('success', 'Pembayaran berhasil dihapus');
    }

    /**
     * Cetak struk pembayaran dalam format PDF
     */
    public function cetatakStruk(RmPembayaran $RmPembayaran)
    {
        $RmPembayaran->load('pesanan.pemeriksaan.pasien', 'pesanan.pemeriksaan.resep', 'pesanan.pemeriksaan.user', 'pesanan.frame', 'pesanan.lensa', 'pesanan.aksesoris', 'pesanan.pembayarans');
        $RmPemeriksaan = $RmPembayaran->pesanan->pemeriksaan;
        $pengaturan = Pengaturan::first();
        // pembayran opsy
        // return view('pdf.strukPembayaranOpsy', compact('RmPemeriksaan', 'RmPembayaran', 'pengaturan'));

        // pembayaran Continuous form
        return view('pdf.strukPembayaranContinuous', compact('RmPemeriksaan', 'RmPembayaran', 'pengaturan'));
    }

    /**
     * Cetak surat balasan pemeriksaan dalam format PDF
     */
    public function cetakSuratBalasan(RmPemeriksaan $RmPemeriksaan)
    {
        // return view('pdf.suratBalasan', compact('RmPemeriksaan')); // for debug
        $pdf = Pdf::loadView('pdf.suratBalasan', compact('RmPemeriksaan'));
        return $pdf->download('SuratBalasan-' . str_pad($RmPemeriksaan->id, 6, '0', STR_PAD_LEFT) . '.pdf');
    }

    /**
     * Simpan data pengambilan pesanan kacamata dengan tanda tangan digital
     */
    public function storePengambilan(Request $request, RmPemeriksaan $RmPemeriksaan)
    {
        $validated = $request->validate([
            'nama_pengambil' => 'required|string|max:255',
            'hub_pengambil' => 'required|string|max:255',
            'bukti_pengambil' => 'required|string', // base64 canvas data
        ]);

        // cek sisa pembayaran
        $hargaTotal = $RmPemeriksaan->pesanan->biaya_kacamata;
        $totalPembayaran = $RmPemeriksaan->pesanan->pembayarans->sum('jumlah');
        $sisaPembayaran = $hargaTotal - $totalPembayaran;

        if ($sisaPembayaran > 0) {
            return redirect()
                ->route('datamedis.show', [$RmPemeriksaan])
                ->with('error', 'Pembayaran belum selesai. Selesaikan pembayaran terlebih dahulu sebelum melakukan pengambilan.');
        }

        // Decode base64 image and save to storage
        if (strpos($validated['bukti_pengambil'], 'data:image') === 0) {
            $imageData = explode(',', $validated['bukti_pengambil']);
            $imageBinary = base64_decode($imageData[1]);
            $filename = 'pengambilan_' . $RmPemeriksaan->pesanan->id . '_' . time() . '.png';
            $filePath = 'pengambilan/' . $filename;

            Storage::disk('public')->put($filePath, $imageBinary);
            $validated['bukti_pengambil'] = 'storage/' . $filePath;
        }

        RmPengambilan::create([
            'pesanan_id' => $RmPemeriksaan->pesanan->id,
            'nama_pengambil' => $validated['nama_pengambil'],
            'hub_pengambil' => $validated['hub_pengambil'],
            'bukti_pengambil' => $validated['bukti_pengambil'],
        ]);

        // Update status pesanan
        $RmPemeriksaan->pesanan->update([
            'status' => 'diambil',
            'tanggal_pengambilan' => now(),
        ]);

        return redirect()
            ->route('datamedis.show', [$RmPemeriksaan])
            ->with('success', 'Pengambilan pesanan berhasil dicatat');
    }

    /**
     * Tampilkan form pencarian pasien atau form untuk membuat pasien baru (step 1)
     */
    public function createStep1(Request $request)
    {
        $pasien = null;
        $action = $request->query('action');
        $nama_pasien = $request->query('nama_pasien') ?? '';
        if ($action === 'search') {
            $request->validate([
                'nama_pasien' => 'required|string',
            ]);

            $pasien = RmPasien::where('nama_pasien', 'like', '%' . $request->nama_pasien . '%')->get();
        }

        return view('admin.rekammedis.datamedis_create_step1', compact('action', 'pasien', 'nama_pasien'));
    }

    /**
     * Simpan data biodata pasien baru (step 1) dan redirect ke step 2
     */
    public function storeStep1(Request $request)
    {
        $validated = $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'no_hp'       => 'nullable|string|max:20',
            'email'       => 'nullable|email|max:255',
            'alamat'      => 'nullable|string',
            'tanggal_lahir' => 'required|date',
            'kategori'    => 'required|in:umum,bpjs,asuransi',
            'no_kartu'    => 'nullable|string|max:50',
            'kelas'       => 'nullable|in:1,2,3',
        ]);

        $pasien = RmPasien::create($validated);

        return redirect()
            ->route('datamedis.create.step2', $pasien->id)
            ->with('success', 'Biodata pasien berhasil disimpan');
    }

    /**
     * Tampilkan form untuk input pemeriksaan dan pesanan kacamata (step 2)
     */
    public function createStep2(RmPasien $pasien)
    {
        $frame = Frame::all();
        $lensa = Lensa::all();
        $aksesoris = Aksesoris::all();
        return view('admin.rekammedis.datamedis_create_step2', compact('pasien', 'frame', 'lensa', 'aksesoris'));
    }

    /**
     * Simpan data pemeriksaan, resep, dan pesanan kacamata pasien (step 2)
     */
    public function storeStep2(Request $request, RmPasien $pasien)
    {
        // return $request->all();
        $validated = $request->validate([
            'no_sep' => 'required|string',
            'diagnosa' => 'required|string',

            'keluhan_utama' => 'required|string',
            'riwayat_penyakit' => 'required|string',
            'penyakit_sekarang' => 'required|string',
            'penyakit_keluarga' => 'required|string',
            'kebiasaan' => 'required|string',
            'pengobatan' => 'required|string',

            'resep_dari' => 'required|string',
            'resep_tanggal' => 'required|date',

            'resep.kanan.sph' => 'numeric|required',
            'resep.kanan.cyl' => 'numeric|required',
            'resep.kanan.axis' => 'numeric|required',
            'resep.kanan.add' => 'numeric|required',
            'resep.kanan.pd' => 'numeric|required',

            'resep.kiri.sph' => 'numeric|required',
            'resep.kiri.cyl' => 'numeric|required',
            'resep.kiri.axis' => 'numeric|required',
            'resep.kiri.add' => 'numeric|required',
            'resep.kiri.pd' => 'numeric|required',

            'frame_id' => 'required|exists:frames,id',
            'lensa_id' => 'required|exists:lensas,id',
            'aksesoris_id' => 'required|exists:aksesoris,id',
            'biaya_kacamata' => 'required|numeric',
            'tanggal_dipesan' => 'required|date',
            'tanggal_pengambilan' => 'required|date',
        ]);

        // return $validated;

        $RmPemeriksaan = RmPemeriksaan::create([
            'pasien_id' => $pasien->id,
            'user_id' => auth()->id(),
            'no_sep' => $validated['no_sep'],

            'keluhan_utama' => $validated['keluhan_utama'],
            'riwayat_penyakit' => $validated['riwayat_penyakit'],
            'penyakit_sekarang' => $validated['penyakit_sekarang'],
            'penyakit_keluarga' => $validated['penyakit_keluarga'],
            'kebiasaan' => $validated['kebiasaan'],
            'pengobatan' => $validated['pengobatan'],
            'diagnosa' => $validated['diagnosa']
        ]);

        $RMresep = RmResep::create([
            'pemeriksaan_id' => $RmPemeriksaan->id,
            'resep_dari' => $validated['resep_dari'],
            'tanggal' => $validated['resep_tanggal'],

            'od_sferis' => $validated['resep']['kanan']['sph'],
            'od_silindris' => $validated['resep']['kanan']['cyl'],
            'od_axis' => $validated['resep']['kanan']['axis'],
            'od_add_lensa' => $validated['resep']['kanan']['add'],
            'pd_od' => $validated['resep']['kanan']['pd'],

            'os_sferis' => $validated['resep']['kiri']['sph'],
            'os_silindris' => $validated['resep']['kiri']['cyl'],
            'os_axis' => $validated['resep']['kiri']['axis'],
            'os_add_lensa' => $validated['resep']['kiri']['add'],
            'pd_os' => $validated['resep']['kiri']['pd'],
        ]);

        $pesanan = RmPesanan::create([
            'pemeriksaan_id' => $RmPemeriksaan->id,
            'resep_id' => $RMresep->id,
            'frame_id' => $validated['frame_id'],
            'lensa_id' => $validated['lensa_id'],
            'biaya_kacamata' => $validated['biaya_kacamata'],
            'tanggal_dipesan' => $validated['tanggal_dipesan'],
            'tanggal_pengambilan' => $validated['tanggal_pengambilan'],
        ]);

        // Simpan relasi aksesoris ke tabel pivot
        $pesanan->aksesoris()->sync($validated['aksesoris_id']);

        return redirect()
            ->route('datamedis.show', [$RmPemeriksaan])
            ->with('success', 'Data medis berhasil disimpan');
    }

    /**
     * Hapus data medis pemeriksaan beserta resep, pesanan, dan pembayaran terkait
     */
    public function destroy(RmPemeriksaan $RmPemeriksaan)
    {
        $RmPemeriksaan->delete();
        return redirect()
            ->route('datamedis.index')
            ->with('success', 'Data medis berhasil dihapus');
    }
}
