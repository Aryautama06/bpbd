<?php

namespace App\Http\Controllers;

use App\Models\Dana;
use Illuminate\Http\Request;

class DanaController extends Controller
{
    public function index()
    {
        $danas = Dana::latest()->get();
        $totalDana = Dana::sum('jumlah');
        $totalAPBD = Dana::where('jenis_dana', 'APBD')->sum('jumlah');
        $totalAPBN = Dana::where('jenis_dana', 'APBN')->sum('jumlah');
        $totalBantuan = Dana::where('jenis_dana', 'Bantuan')->sum('jumlah');

        return view('dana.index', compact('danas', 'totalDana', 'totalAPBD', 'totalAPBN', 'totalBantuan'));
    }

    public function create()
    {
        return view('dana.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_anggaran' => 'required|string|unique:dana',
            'nama_kegiatan' => 'required|string|max:255',
            'jenis_dana' => 'required|in:APBD,APBN,Bantuan',
            'jumlah' => 'required|numeric|min:0',
            'tanggal_terima' => 'required|date',
            'status' => 'required|in:Diterima,Digunakan,Sisa',
            'keterangan' => 'nullable|string',
            'dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
        ]);

        if ($request->hasFile('dokumen')) {
            $dokumen = $request->file('dokumen');
            $path = $dokumen->store('public/dokumen');
            $validated['dokumen'] = $path;
        }

        Dana::create($validated);

        return redirect()
            ->route('dana.index')
            ->with('success', 'Data dana berhasil ditambahkan');
    }

    public function show(Dana $dana)
    {
        return view('dana.show', compact('dana'));
    }

    public function edit(Dana $dana)
    {
        return view('dana.edit', compact('dana'));
    }

    public function update(Request $request, Dana $dana)
    {
        $validated = $request->validate([
            'kode_anggaran' => 'required|string|unique:dana,kode_anggaran,' . $dana->id,
            'nama_kegiatan' => 'required|string|max:255',
            'jenis_dana' => 'required|in:APBD,APBN,Bantuan',
            'jumlah' => 'required|numeric|min:0',
            'tanggal_terima' => 'required|date',
            'status' => 'required|in:Diterima,Digunakan,Sisa',
            'keterangan' => 'nullable|string',
            'dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
        ]);

        if ($request->hasFile('dokumen')) {
            // Delete old file if exists
            if ($dana->dokumen) {
                Storage::delete($dana->dokumen);
            }
            
            $dokumen = $request->file('dokumen');
            $path = $dokumen->store('public/dokumen');
            $validated['dokumen'] = $path;
        }

        $dana->update($validated);

        return redirect()
            ->route('dana.index')
            ->with('success', 'Data dana berhasil diperbarui');
    }

    public function destroy(Dana $dana)
    {
        try {
            $kode = $dana->kode_dana;
            $dana->delete();
            
            return redirect()
                ->route('dana.index')
                ->with('success', "Dana dengan kode '$kode' berhasil dihapus");
        } catch (\Exception $e) {
            return redirect()
                ->route('dana.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data dana');
        }
    }
}
