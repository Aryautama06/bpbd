<?php
namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlternatifController extends Controller
{
    public function index()
    {
        $alternatifs = Alternatif::orderBy('kode_alternatif')->get();
        return view('alternatif.index', compact('alternatifs'));
    }

    public function create()
    {
        return view('alternatif.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Alternatif::rules());

        if ($validator->fails()) {
            return redirect()
                ->route('alternatif.create')
                ->withErrors($validator)
                ->withInput();
        }

        Alternatif::create($request->all());

        return redirect()
            ->route('alternatif.index')
            ->with('success', 'Data alternatif berhasil ditambahkan');
    }

    public function edit(Alternatif $alternatif)
    {
        return view('alternatif.edit', compact('alternatif'));
    }

    public function update(Request $request, Alternatif $alternatif)
    {
        $validator = Validator::make($request->all(), Alternatif::rules($alternatif->id));

        if ($validator->fails()) {
            return redirect()
                ->route('alternatif.edit', $alternatif)
                ->withErrors($validator)
                ->withInput();
        }

        $alternatif->update($request->all());

        return redirect()
            ->route('alternatif.index')
            ->with('success', 'Data alternatif berhasil diperbarui');
    }

    public function destroy(Alternatif $alternatif)
    {
        $alternatif->delete();

        return redirect()
            ->route('alternatif.index')
            ->with('success', 'Data alternatif berhasil dihapus');
    }

    public function show(Alternatif $alternatif)
    {
        return view('alternatif.show', compact('alternatif'));
    }
}