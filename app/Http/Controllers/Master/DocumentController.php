<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::latest()->paginate(10);

        return view('admin.master.dokumen_index', compact('documents'));
    }
    public function create()
    {
        return view('admin.master.dokumen_create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        Document::create($validated);

        return redirect()
            ->route('document.index')
            ->with('success', 'Dokumen berhasil ditambahkan');
    }


    public function edit(Document $document)
    {
        return view('admin.master.dokumen_edit', compact('document'));
    }


    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $document->update($validated);

        return redirect()
            ->route('document.index')
            ->with('success', 'Dokumen berhasil diperbarui');
    }

    public function destroy(Document $document)
    {
        $document->delete();

        return redirect()
            ->route('document.index')
            ->with('success', 'Dokumen berhasil dihapus');
    }
}
