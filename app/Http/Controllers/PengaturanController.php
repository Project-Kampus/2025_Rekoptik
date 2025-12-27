<?php

namespace App\Http\Controllers;

use App\Models\pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    public function index()
    {
        $pengaturan = pengaturan::first();

        return view('admin.pengaturan_index', compact('pengaturan'));
    }

    /**
     * Simpan / Update pengaturan
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama_aplikasi' => 'required|string|max:255',
            'alamat'        => 'nullable|string',
            'no_hp'         => 'nullable|string|max:20',
            'email'         => 'nullable|email',
            'logo'          => 'nullable|file|mimes:png,jpg,jpeg,ico|max:2048',
        ]);

        $pengaturan = Pengaturan::firstOrCreate([]);

        // upload logo jika ada
        if ($request->hasFile('logo')) {

            if ($pengaturan->logo) {
                Storage::disk('public')->delete($pengaturan->logo);
            }

            $logoPath = $request->file('logo')
                ->store('logo', 'public');

            $pengaturan->logo = $logoPath;
        }

        $pengaturan->update([
            'nama_aplikasi' => $request->nama_aplikasi,
            'alamat'        => $request->alamat,
            'no_hp'         => $request->no_hp,
            'email'         => $request->email,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Pengaturan berhasil diperbarui');
    }
}
