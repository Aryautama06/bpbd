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
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'tanggal' => 'required|date',
                'jenis_bencana' => 'required|string|max:255',
                'lokasi' => 'required|string|max:255',
                'kecamatan' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'dampak' => 'required|string',
                'korban_jiwa' => 'required|integer|min:0',
                'kerusakan' => 'required|string|max:255',
                'kerugian' => 'required|numeric|min:0',
                'status' => 'required|in:Proses,Selesai',
            ]);

            Bencana::create($validated);
            
            DB::commit();
            return redirect()->route('bencana.index')
                           ->with('success', 'Data bencana berhasil ditambahkan');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data')
                        ->withInput();
        }
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
        try {
            return view('bencana.edit', compact('bencana'));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memuat form edit');
        }
    }

    public function update(Request $request, Bencana $bencana)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'tanggal' => 'required|date',
                'jenis_bencana' => 'required|string|max:255',
                'lokasi' => 'required|string|max:255',
                'kecamatan' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'dampak' => 'required|string',
                'korban_jiwa' => 'required|integer|min:0',
                'kerusakan' => 'required|string|max:255',
                'kerugian' => 'required|numeric|min:0',
                'status' => 'required|in:Proses,Selesai',
            ]);

            $bencana->update($validated);

            DB::commit();
            return redirect()->route('bencana.index')
                           ->with('success', 'Data bencana berhasil diperbarui');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data')
                        ->withInput();
        }
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
