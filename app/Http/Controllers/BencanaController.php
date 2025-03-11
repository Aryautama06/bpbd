<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BencanaController extends Controller
{
    public function index()
    {
        try {
            $bencanas = Bencana::latest()->paginate(10);
            return view('bencana.index', compact('bencanas'));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memuat data bencana');
        }
    }

    public function create()
    {
        return view('bencana.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jenis_bencana' => 'required|string',
            'lokasi' => 'required|string',
            'kecamatan' => 'required|string',
            'deskripsi' => 'required|string',
            'dampak' => 'nullable|string',
            'dampak_korban' => 'nullable|string',
            'dampak_kerusakan' => 'nullable|string',
            'status' => 'required|in:Proses,Selesai',
            'kerugian' => 'required|numeric'
        ]);

        $bencana = Bencana::create($validated);

        return redirect()
            ->route('bencana.index')
            ->with('success', 'Data bencana berhasil ditambahkan!');
    }

    public function show(Bencana $bencana)
    {
        try {
            return view('bencana.show', compact('bencana'));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menampilkan data');
        }
    }

    public function edit(Bencana $bencana)
    {
        return view('bencana.edit', compact('bencana'));
    }

    public function update(Request $request, Bencana $bencana)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jenis_bencana' => 'required|string',
            'lokasi' => 'required|string',
            'kecamatan' => 'required|string',
            'deskripsi' => 'required|string',
            'dampak' => 'nullable|string',
            'dampak_korban' => 'nullable|string',
            'dampak_kerusakan' => 'nullable|string',
            'status' => 'required|in:Proses,Selesai',
            'kerugian' => 'required|numeric'
        ]);

        $bencana->update($validated);

        return redirect()
            ->route('bencana.index')
            ->with('success', 'Data bencana berhasil diperbarui!');
    }

    public function destroy(Bencana $bencana)
    {
        try {
            DB::beginTransaction();
            
            $bencana->delete();
            
            DB::commit();
            return redirect()->route('bencana.index')
                           ->with('success', 'Data bencana berhasil dihapus');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }
}
