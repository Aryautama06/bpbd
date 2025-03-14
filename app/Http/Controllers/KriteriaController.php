<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::all();
        $totalBobot = Kriteria::sum('bobot');
        $totalBenefit = Kriteria::where('jenis', 'Benefit')->count();
        $totalCost = Kriteria::where('jenis', 'Cost')->count();

        return view('kriteria.index', compact('kriterias', 'totalBobot', 'totalBenefit', 'totalCost'));
    }

    public function create()
    {
        return view('kriteria.create');
    }

    protected function getValidationMessages()
    {
        return [
            'kode_kriteria.required' => 'Kode kriteria harus diisi',
            'kode_kriteria.unique' => 'Kode kriteria sudah digunakan',
            'nama_kriteria.required' => 'Nama kriteria harus diisi',
            'jenis.required' => 'Jenis kriteria harus dipilih',
            'jenis.in' => 'Jenis kriteria tidak valid'
        ];
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Kriteria::rules());

        if ($validator->fails()) {
            return redirect()
                ->route('kriteria.create')
                ->withErrors($validator)
                ->withInput();
        }

        Kriteria::create($request->all());

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
        $validator = Validator::make($request->all(), Kriteria::rules($kriteria->id));

        if ($validator->fails()) {
            return redirect()
                ->route('kriteria.edit', $kriteria)
                ->withErrors($validator)
                ->withInput();
        }

        $kriteria->update($request->all());

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