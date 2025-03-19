<?php

namespace App\Http\Controllers;

use App\Models\Dana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Fix the import here
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

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
        $request->validate([
            'kode_dana' => 'required|unique:dana',
            'jumlah' => 'required|numeric',
            'status' => 'required',
            'keterangan' => 'nullable',
            'bukti' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);

        try {
            $data = $request->all();
            
            // Handle file upload
            if ($request->hasFile('bukti')) {
                $file = $request->file('bukti');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('public/bukti_dana', $fileName);
                $data['bukti'] = $fileName;
            }

            Dana::create($data);

            return redirect()->route('dana.index')
                ->with('success', 'Data dana berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan data dana. ' . $e->getMessage());
        }
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

    public function downloadBukti($filename)
    {
        try {
            $path = 'public/bukti_dana/' . $filename;
            
            if (!Storage::exists($path)) {
                return back()->with('error', 'File tidak ditemukan.');
            }

            $mimeType = Storage::mimeType($path);
            $headers = [
                'Content-Type' => $mimeType,
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ];

            return Storage::download($path, $filename, $headers);
            
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengunduh file.');
        }
    }
}
