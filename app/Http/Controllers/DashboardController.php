<?php

namespace App\Http\Controllers;

use App\Models\Personel;
use App\Models\Peralatan;
use App\Models\Dana;
use App\Models\Bencana;
use App\Models\HasilPerhitungan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Get latest data counts
        $stats = [
            'personel' => [
                'total' => Personel::count(),
                'pns' => Personel::where('status', 'PNS')->count(),
                'kontrak' => Personel::where('status', 'Kontrak')->count(),
                'sukarela' => Personel::where('status', 'Sukarela')->count(),
            ],
            'peralatan' => [
                'total' => Peralatan::count(),
                'baik' => Peralatan::where('kondisi', 'Baik')->count(),
                'rusak_ringan' => Peralatan::where('kondisi', 'Rusak Ringan')->count(),
                'rusak_berat' => Peralatan::where('kondisi', 'Rusak Berat')->count(),
            ],
            'dana' => [
                'total' => Dana::sum('jumlah'),
                'tersedia' => Dana::where('status', 'Tersedia')->sum('jumlah'),
                'terpakai' => Dana::where('status', 'Terpakai')->sum('jumlah'),
                'count' => Dana::count(),
            ],
            'bencana' => [
                'total' => Bencana::count(),
                'bulan_ini' => Bencana::whereMonth('tanggal', now()->month)
                    ->whereYear('tanggal', now()->year)
                    ->count(),
                'tahun_ini' => Bencana::whereYear('tanggal', now()->year)->count(),
            ],
            'perhitungan' => [
                'total' => HasilPerhitungan::count(),
                'terakhir' => HasilPerhitungan::latest()->first(),
            ],
        ];

        return view('dashboard', compact('stats'));
    }
}