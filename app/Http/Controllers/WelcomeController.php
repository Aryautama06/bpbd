<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\Personel;
use App\Models\Peralatan;
use App\Models\Dana;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $stats = [
            'bencana' => [
                'total' => Bencana::count(),
                'bulan_ini' => Bencana::whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->count(),
            ],
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
            ],
        ];

        return view('welcome', compact('stats'));
    }
}