<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::latest()->get();
        $totalBobot = Kriteria::sum('bobot');
        $totalBenefit = Kriteria::where('jenis', 'Benefit')->count();
        $totalCost = Kriteria::where('jenis', 'Cost')->count();

        return view('kriteria.index', compact('kriterias', 'totalBobot', 'totalBenefit', 'totalCost'));
    }

    public function create()
    {
        return view('kriteria.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_kriteria' => 'required|string|unique:kriteria',
            'nama_kriteria' => 'required|string|max:255',
            'bobot' => 'required|integer|min:1|max:100',
            'jenis' => 'required|in:Benefit,Cost',
            'keterangan' => 'nullable|string'
        ]);

        Kriteria::create($validated);

        return redirect()
            ->route('kriteria.index')
            ->with('success', 'Kriteria berhasil ditambahkan');
    }

    public function show(Kriteria $kriteria)
    {
        return view('kriteria.show', compact('kriteria'));
    }

    public function edit(Kriteria $kriteria)
    {
        return view('kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, Kriteria $kriteria)
    {
        $validated = $request->validate([
            'kode_kriteria' => 'required|string|unique:kriteria,kode_kriteria,' . $kriteria->id,
            'nama_kriteria' => 'required|string|max:255',
            'bobot' => 'required|integer|min:1|max:100',
            'jenis' => 'required|in:Benefit,Cost',
            'keterangan' => 'nullable|string'
        ]);

        $kriteria->update($validated);

        return redirect()
            ->route('kriteria.index')
            ->with('success', 'Kriteria berhasil diperbarui');
    }

    public function destroy(Kriteria $kriteria)
    {
        $kriteria->delete();

        return redirect()
            ->route('kriteria.index')
            ->with('success', 'Kriteria berhasil dihapus');
    }
}