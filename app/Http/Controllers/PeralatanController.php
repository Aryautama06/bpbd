<?php

namespace App\Http\Controllers;

use App\Models\Peralatan;
use Illuminate\Http\Request;

class PeralatanController extends Controller
{
    public function index()
    {
        $peralatan = Peralatan::latest()->get();
        return view('peralatan.index', compact('peralatan'));
    }

    public function create()
    {
        return view('peralatan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kode_alat' => 'required|string|unique:peralatan',
            'kategori' => 'required|string',
            'jumlah' => 'required|integer|min:0',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'spesifikasi' => 'nullable|string',
            'lokasi_penyimpanan' => 'required|string',
            'tanggal_pengadaan' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        Peralatan::create($validated);

        return redirect()
            ->route('peralatan.index')
            ->with('success', 'Data peralatan berhasil ditambahkan');
    }

    public function show(Peralatan $peralatan)
    {
        return view('peralatan.show', compact('peralatan'));
    }

    public function edit(Peralatan $peralatan)
    {
        return view('peralatan.edit', compact('peralatan'));
    }

    public function update(Request $request, Peralatan $peralatan)
    {
        $validated = $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kode_alat' => 'required|string|unique:peralatan,kode_alat,' . $peralatan->id,
            'kategori' => 'required|string',
            'jumlah' => 'required|integer|min:0',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'spesifikasi' => 'nullable|string',
            'lokasi_penyimpanan' => 'required|string',
            'tanggal_pengadaan' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        $peralatan->update($validated);

        return redirect()
            ->route('peralatan.index')
            ->with('success', 'Data peralatan berhasil diperbarui');
    }

    public function destroy(Peralatan $peralatan)
    {
        $peralatan->delete();

        return redirect()
            ->route('peralatan.index')
            ->with('success', 'Data peralatan berhasil dihapus');
    }

    public function detail(Peralatan $peralatan)
    {
        return response()->json($peralatan);
    }
}
