<?php

namespace App\Http\Controllers;

use App\Models\Personel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PersonelController extends Controller
{
    public function index()
    {
        $personels = Personel::latest()->get();
        return view('personel.index', compact('personels'));
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
            'nip' => 'nullable|string|unique:personels,nip,' . $personel->id,
            'jabatan' => 'required|string',
            'status' => 'required|in:PNS,Kontrak,Sukarela',
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'foto' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($personel->foto) {
                Storage::disk('public')->delete($personel->foto);
            }
            $path = $request->file('foto')->store('personel-photos', 'public');
            $validated['foto'] = $path;
        }

        $personel->update($validated);

        return redirect()
            ->route('personel.index')
            ->with('success', 'Data personel berhasil diperbarui!');
    }

    public function destroy(Personel $personel)
    {
        if ($personel->foto) {
            Storage::disk('public')->delete($personel->foto);
        }
        
        $personel->delete();

        return redirect()
            ->route('personel.index')
            ->with('success', 'Data personel berhasil dihapus!');
    }

    public function show(Personel $personel)
    {
        return view('personel.show', compact('personel'));
    }
}
