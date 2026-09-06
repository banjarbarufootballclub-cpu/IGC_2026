<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lembar Pengesahan Resmi - {{ $tim->nama_ssb }}</title>
    <style>
        body { font-family: Arial, sans-serif; color: #000; line-height: 1.4; margin: 0; padding: 20px; }
        .header { text-align: center; border-bottom: 3px double #000; padding-bottom: 10px; margin-bottom: 20px; }
        .header h2, .header h3 { margin: 2px 0; }
        .title { text-align: center; font-weight: bold; font-size: 16px; margin: 20px 0; text-decoration: underline; }
        .info-table { width: 100%; margin-bottom: 15px; font-size: 14px; }
        .info-table td { padding: 3px 0; }
        table.data { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 12px; }
        table.data th, table.data td { border: 1px solid #000; padding: 6px; text-align: left; }
        table.data th { background-color: #f2f2f2; text-align: center; }
        .text-center { text-align: center; }
        .sign-area { width: 100%; margin-top: 40px; font-size: 14px; }
        .sign-box { float: right; text-align: center; width: 250px; }
        .sign-space { height: 60px; }
        @media print {
            body { padding: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">

    <!-- TOMBOL CETAK (Hanya tampil di layar, hilang saat dicetak) -->
    <div class="no-print" style="text-align: right; margin-bottom: 20px;">
        <button onclick="window.print()" style="background: #1e3a8a; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;">🖨️ Cetak / Simpan PDF</button>
    </div>

    <!-- KOP SURAT -->
    <div class="header">
        <h3>INDONESIA GRASSROOTS CHAMPIONSHIP (IGC)</h3>
        <h2>REGIONAL KALSELTENG 2026</h2>
    </div>

    <div class="title">LEMBAR PENGESAHAN TIM PESERTA</div>

    <!-- IDENTITAS TIM -->
    <table class="info-table">
        <tr>
            <td style="width: 150px;"><strong>Nama SSB / Klub</strong></td>
            <td>: <strong>{{ $tim->nama_ssb }}</strong></td>
            <td style="width: 150px;"><strong>Kategori Usia</strong></td>
            <td>: {{ $tim->kategori_usia }}</td>
        </tr>
        <tr>
            <td><strong>Pelatih Utama</strong></td>
            <td>: {{ $tim->nama_pelatih }}</td>
            <td><strong>Status Dokumen</strong></td>
            <td>: <span style="color: green; font-weight: bold;">SAH & TERVALIDASI</span></td>
        </tr>
    </table>

    <!-- TABEL PEMAIN SAH -->
    <p style="font-weight: bold; margin-bottom: 5px;">A. Daftar Pemain Sah</p>
    <table class="data">
        <thead>
            <tr>
                <th style="width: 30px;">No</th>
                <th>Nama Lengkap Pemain</th>
                <th style="width: 100px;">NISN</th>
                <th style="width: 90px;">Posisi</th>
                <th style="width: 120px;">Tempat, Tgl Lahir</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tim->pemains as $index => $p)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td><strong>{{ $p->nama_pemain }}</strong></td>
                <td class="text-center">{{ $p->nisn }}</td>
                <td class="text-center">{{ $p->posisi }}</td>
                <td>{{ $p->tempat_lahir }}, {{ $p->tanggal_lahir }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center" style="font-style: italic; color: gray;">Belum ada pemain yang disahkan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- TABEL OFFICIAL SAH -->
    <p style="font-weight: bold; margin-top: 20px; margin-bottom: 5px;">B. Daftar Official Sah</p>
    <table class="data">
        <thead>
            <tr>
                <th style="width: 30px;">No</th>
                <th>Nama Lengkap Official</th>
                <th style="width: 150px;">Jabatan</th>
                <th style="width: 120px;">No. WhatsApp</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tim->officials as $index => $o)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td><strong>{{ $o->nama_official }}</strong></td>
                <td>{{ $o->jabatan }}</td>
                <td class="text-center">{{ $o->no_hp ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center" style="font-style: italic; color: gray;">Belum ada official yang disahkan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- TANDA TANGAN PANITIA -->
    <div class="sign-area">
        <div class="sign-box">
            <p>Banjarbaru, {{ date('d F Y') }}</p>
            <p><strong>Panitia</strong></p>
            <div class="sign-space"></div>
            <p><strong>( _____________________ )</strong></p>
        </div>
    </div>

</body>
</html>