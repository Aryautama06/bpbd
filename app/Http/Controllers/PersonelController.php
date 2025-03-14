<?php

namespace App\Http\Controllers;

use App\Models\Personel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PersonelController extends Controller
{
    public function index()
    {
        $personel = Personel::selectRaw('
            COUNT(*) as total,
            SUM(CASE WHEN status = "Aktif" THEN 1 ELSE 0 END) as aktif,
            SUM(CASE WHEN status = "Non-Aktif" THEN 1 ELSE 0 END) as non_aktif,
            SUM(CASE WHEN status = "Bertugas" THEN 1 ELSE 0 END) as bertugas
        ')->first();
        
        $list_personel = Personel::orderBy('nama')->get();

        return view('personel.index', compact('personel', 'list_personel'));
    }

    public function create()
    {
        return view('personel.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|unique:personels',
            'jabatan' => 'required|string',
            'status' => 'required|in:PNS,Kontrak,Sukarela',
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'foto' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('personel-photos', 'public');
            $validated['foto'] = $path;
        }

        Personel::create($validated);

        return redirect()
            ->route('personel.index')
            ->with('success', 'Data personel berhasil ditambahkan!');
    }

    public function edit(Personel $personel)
    {
        return view('personel.edit', compact('personel'));
    }

    public function update(Request $request, Personel $personel)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:255',
            'jabatan' => 'required|string|max:255',
            'status' => 'required|in:PNS,Kontrak,Sukarela',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'no_hp' => 'required|string|max:255',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($personel->foto) {
                Storage::delete($personel->foto);
            }
            $validated['foto'] = $request->file('foto')->store('public/personel');
        }

        $personel->update($validated);

        return redirect()
            ->route('personel.show', $personel)
            ->with('success', 'Data personel berhasil diperbarui');
    }

    public function destroy(Personel $personel)
    {
        try {
            $nama = $personel->nama;
            $personel->delete();
            
            return redirect()
                ->route('personel.index')
                ->with('success', "Data personel '$nama' berhasil dihapus");
        } catch (\Exception $e) {
            return redirect()
                ->route('personel.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data personel');
        }
    }

    public function show(Personel $personel)
    {
        return view('personel.show', compact('personel'));
    }
}
