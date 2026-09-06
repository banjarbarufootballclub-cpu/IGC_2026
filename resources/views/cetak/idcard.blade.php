<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak ID Card - {{ $tim->nama_tim ?? 'Tim' }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 20px;
        }
        .id-card {
            width: 320px;
            height: 215px;
            background: #ffffff;
            border: 2px solid #333333;
            border-radius: 12px;
            color: #000000;
            padding: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            position: relative;
            box-sizing: border-box;
            margin-bottom: 20px;
            overflow: hidden; /* Agar watermark tidak keluar kartu */
        }
        /* Style untuk Watermark SAH */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 70px;
            font-weight: bold;
            color: rgba(0, 180, 0, 0.12); /* Warna hijau transparan */
            z-index: 0;
            user-select: none;
            pointer-events: none;
            letter-spacing: 5px;
        }
        .header, .content, .footer {
            position: relative;
            z-index: 1; /* Supaya teks tetap di atas watermark */
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #000000;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        .header h3 {
            margin: 0;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #000000;
        }
        .header img {
            height: 24px;
            width: auto;
            object-fit: contain;
        }
        .content {
            display: flex;
            align-items: center;
        }
        .photo {
            width: 70px;
            height: 90px;
            background-color: #ccc;
            border-radius: 6px;
            object-fit: cover;
            border: 2px solid #000000;
        }
        .details {
            margin-left: 15px;
            font-size: 11px;
            color: #000000;
        }
        .details p {
            margin: 2px 0;
        }
        .details strong {
            color: #000000;
        }
        .footer {
            position: absolute;
            bottom: 8px;
            left: 15px;
            right: 15px;
            text-align: center;
            font-size: 9px;
            border-top: 1px solid #cccccc;
            padding-top: 4px;
            color: #555555;
        }
        @media print {
            body { background: none; padding: 0; }
            .id-card { page-break-inside: avoid; border: 1px solid #000; }
        }
    </style>
</head>
<body onload="window.print()">

    @foreach($tim->pemains ?? [] as $p)
    <div class="id-card">
        <!-- Watermark SAH -->
        <div class="watermark">SAH</div>

        <div class="header">
            <h3>PLAYER CARD</h3>
            <img src="{{ asset('logo-igc.png') }}" alt="Logo IGC">
        </div>
        <div class="content">
            <img src="{{ asset('storage/' . $p->foto) }}" alt="Foto" class="photo">
            <div class="details">
                <p>Nama: <br><strong>{{ $p->nama }}</strong></p>
                <p>Tim: <br><strong>{{ $tim->nama_tim ?? '-' }}</strong></p>
                <p>Kelompok Umur: <strong>{{ $tim->kelompok_umur ?? $p->kelompok_umur ?? '-' }}</strong></p>
                <p>No. Punggung: <strong>{{ $p->no_punggung ?? '-' }}</strong></p>
            </div>
        </div>
        <div class="footer">
            Resmi Terdaftar - Turnamen Sepak Bola 2026
        </div>
    </div>
    @endforeach

</body>
</html>