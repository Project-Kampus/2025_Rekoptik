<?php

namespace App\Http\Controllers\RekamMedis;

use App\Http\Controllers\Controller;
use App\Models\RmPasien;
use Illuminate\Http\Request;

class IdentitasPasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = RmPasien::query();

        // Search
        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where(function ($q) use ($search) {
                $q->where('nama_pasien', 'like', "%{$search}%")
                    ->orWhere('no_kartu', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $rmPasiens = $query->paginate(15);

        return view('admin.rekammedis.identitaspasien_index', compact('rmPasiens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.rekammedis.identitaspasien_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'alamat' => 'nullable|string',
            'umur' => 'nullable|integer|min:0',
            'kategori' => 'required|in:bpjs,asuransi,umum',
            'no_kartu' => 'nullable|string|max:100',
            'kelas' => 'nullable|in:1,2,3',
        ]);

        RmPasien::create($validated);

        return redirect()->route('identitaspasien.index')
            ->with('success', 'Data pasien berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(RmPasien $identitaspasien)
    {
        $pemeriksaans = $identitaspasien->pemeriksaans()
            ->with('user', 'resep', 'pesanan')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.rekammedis.identitaspasien_show', compact('identitaspasien', 'pemeriksaans'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RmPasien $identitaspasien)
    {
        return view('admin.rekammedis.identitaspasien_edit', compact('identitaspasien'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RmPasien $identitaspasien)
    {
        $validated = $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'alamat' => 'nullable|string',
            'umur' => 'nullable|integer|min:0',
            'kategori' => 'required|in:bpjs,asuransi,umum',
            'no_kartu' => 'nullable|string|max:100',
            'kelas' => 'nullable|in:1,2,3',
        ]);

        $identitaspasien->update($validated);

        return redirect()->route('identitaspasien.index')
            ->with('success', 'Data pasien berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RmPasien $identitaspasien)
    {
        $identitaspasien->delete();

        return redirect()->route('identitaspasien.index')
            ->with('success', 'Data pasien berhasil dihapus');
    }
}
