<?php
namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    public function index()
    {
        $alternatifs = Alternatif::latest()->get();
        return view('alternatif.index', compact('alternatifs'));
    }

    public function create()
    {
        return view('alternatif.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_alternatif' => 'required|string|unique:alternatif',
            'nama_alternatif' => 'required|string|max:255',
            'deskripsi' => 'nullable|string'
        ]);

        Alternatif::create($validated);

        return redirect()
            ->route('alternatif.index')
            ->with('success', 'Alternatif berhasil ditambahkan');
    }

    public function show(Alternatif $alternatif)
    {
        return view('alternatif.show', compact('alternatif'));
    }

    public function edit(Alternatif $alternatif)
    {
        return view('alternatif.edit', compact('alternatif'));
    }

    public function update(Request $request, Alternatif $alternatif)
    {
        $validated = $request->validate([
            'kode_alternatif' => 'required|string|unique:alternatif,kode_alternatif,' . $alternatif->id,
            'nama_alternatif' => 'required|string|max:255',
            'deskripsi' => 'nullable|string'
        ]);

        $alternatif->update($validated);

        return redirect()
            ->route('alternatif.index')
            ->with('success', 'Alternatif berhasil diperbarui');
    }

    public function destroy(Alternatif $alternatif)
    {
        $alternatif->delete();

        return redirect()
            ->route('alternatif.index')
            ->with('success', 'Alternatif berhasil dihapus');
    }
}