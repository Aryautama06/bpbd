<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Hasil Perhitungan - {{ $hasil->nama_perhitungan }}</title>
    <style>
        @page { margin: 2cm; }
        body {
            font-family: "Times New Roman", serif;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }
        .letterhead {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }
        .logo {
            width: 100px;
            position: absolute;
            left: 30px;
            top: 20px;
        }
        .header-text {
            margin-left: 120px;
            margin-right: 120px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            margin: 20px 0 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        .info-box {
            border: 1px solid #000;
            padding: 10px;
            margin: 20px 0;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <!-- Print Button -->
    <div class="no-print" style="position: fixed; top: 20px; right: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Cetak Laporan
        </button>
    </div>

    <!-- Letterhead -->
    <div class="letterhead">
        <img src="{{ asset('images/logo_bpbd.png') }}" alt="Logo BPBD" class="logo">
        <div class="header-text">
            <div style="font-size: 16px;">PEMERINTAH KABUPATEN DELI SERDANG</div>
            <div style="font-size: 20px; font-weight: bold;">BADAN PENANGGULANGAN BENCANA DAERAH</div>
            <div style="font-size: 12px;">Jl. Karya Asih, Perbarakan, Kec. Pagar Merbau, Kabupaten Deli Serdang, Sumatera Utara 20518</div>
            <div style="font-size: 12px;">Telp. (0332) 123456 Email: bpbd@deliseredang.go.id</div>
        </div>
    </div>

    <!-- Report Content -->
    <div class="title">LAPORAN HASIL PERHITUNGAN SPK</div>
    <div style="text-align: center; margin-bottom: 30px;">
        {{ $hasil->nama_perhitungan }}
    </div>

    <!-- Info Box -->
    <div class="info-box">
        <table style="border: none; margin: 0;">
            <tr>
                <td style="border: none; width: 150px;">Kode Perhitungan</td>
                <td style="border: none; width: 10px;">:</td>
                <td style="border: none;">{{ $hasil->kode_perhitungan }}</td>
            </tr>
            <tr>
                <td style="border: none;">Tanggal</td>
                <td style="border: none;">:</td>
                <td style="border: none;">{{ $hasil->created_at->format('d F Y') }}</td>
            </tr>
        </table>
    </div>

    <!-- Bobot Kriteria -->
    <h3>A. Bobot Kriteria (Hasil AHP)</h3>
    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Kriteria</th>
                <th>Jenis</th>
                <th>Bobot</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kriterias as $kriteria)
            <tr>
                <td>{{ $kriteria->kode_kriteria }}</td>
                <td>{{ $kriteria->nama_kriteria }}</td>
                <td>{{ ucfirst($kriteria->jenis) }}</td>
                <td>{{ number_format($hasil->bobot_ahp['bobotPrioritas'][$kriteria->id] * 100, 2) }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Hasil Perankingan -->
    <h3>B. Hasil Perankingan TOPSIS</h3>
    <table>
        <thead>
            <tr>
                <th>Ranking</th>
                <th>Kode</th>
                <th>Nama Alternatif</th>
                <th>Nilai Preferensi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $ranking = 1;
                $sortedAlternatifs = $alternatifs->sortByDesc(function($alt) use ($hasil) {
                    return $hasil->hasil_topsis['preferensi'][$alt->id] ?? 0;
                });
            @endphp
            
            @foreach($sortedAlternatifs as $alternatif)
                <tr>
                    <td>{{ $ranking++ }}</td>
                    <td>{{ $alternatif->kode_alternatif }}</td>
                    <td>{{ $alternatif->nama_alternatif }}</td>
                    <td>{{ number_format(($hasil->hasil_topsis['preferensi'][$alternatif->id] ?? 0) * 100, 2) }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Signature -->
    <div class="signature">
        <p>Deli Serdang, {{ now()->format('d F Y') }}</p>
        <p>Kepala BPBD Kabupaten Deli Serdang</p>
        <br><br><br>
        <p style="font-weight: bold; text-decoration: underline;">Nama Kepala BPBD</p>
        <p>NIP. 19XXXXXXXXXX</p>
    </div>
</body>
</html>