<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak ID Card - {{ $team->nama_tim ?? 'Tim' }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eee;
            margin: 0;
            padding: 20px;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .card {
            width: 250px;
            height: 380px;
            background: #fff;
            border: 1px solid #333;
            border-radius: 8px;
            overflow: hidden;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            page-break-inside: avoid;
            margin-bottom: 20px;
        }
        .card-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 10px;
            border-bottom: 2px solid #b30000;
        }
        .header-logo {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }
        .header-text {
            font-size: 9px;
            font-weight: bold;
            text-align: left;
            line-height: 1.3;
            color: #333;
        }
        .card-body {
            padding: 15px;
            flex-grow: 1;
        }
        .photo {
            width: 90px;
            height: 110px;
            border: 2px solid #ddd;
            margin: 0 auto 10px auto;
            background-size: cover;
            background-position: center;
            border-radius: 5px;
        }
        .name {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }
        .role {
            font-size: 11px;
            color: #b30000;
            font-weight: bold;
            margin-bottom: 15px;
            text-transform: uppercase;
        }
        .details {
            font-size: 12px;
            text-align: left;
            border-top: 1px dashed #ccc;
            padding-top: 10px;
        }
        .details p {
            margin: 5px 0;
        }
        .card-footer {
            background-color: #333;
            color: white;
            padding: 8px;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 1px;
        }
        @media print {
            body {
                background: none;
                padding: 0;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="container">
        <!-- Loop ID Card Pemain -->
        @foreach($team->pemains as $p)
        <div class="card">
            <div class="card-header">
                <!-- Ganti nama file logo.png sesuai dengan nama file logo Anda di folder public -->
                <img src="{{ asset('logo.png') }}" alt="Logo IGC" class="header-logo">
                <div class="header-text">
                    INDONESIA GRASSROOT CHAMPIONSHIP<br>
                    <span style="color: #b30000;">2026 REGIONAL KALSELTENG</span>
                </div>
            </div>
            <div class="card-body">
                @if($p->pas_foto)
                    <div class="photo" style="background-image: url('{{ asset('storage/' . $p->pas_foto) }}');"></div>
                @else
                    <div class="photo" style="display: flex; align-items: center; justify-content: center; font-size: 10px; color: #999;">No Photo</div>
                @endif
                <div class="name">{{ $p->nama_pemain }}</div>
                <div class="role">PEMAIN</div>
                <div class="details">
                    <p><strong>SSB:</strong> {{ $team->nama_tim }}</p>
                    <p><strong>Kategori:</strong> {{ $team->kategori_usia }}</p>
                </div>
            </div>
            <div class="card-footer">
                SAH & TERVALIDASI
            </div>
        </div>
        @endforeach

        <!-- Loop ID Card Official -->
        @foreach($team->officials as $o)
        <div class="card">
            <div class="card-header">
                <img src="{{ asset('logo.png') }}" alt="Logo IGC" class="header-logo">
                <div class="header-text">
                    INDONESIA GRASSROOT CHAMPIONSHIP<br>
                    <span style="color: #b30000;">2026 REGIONAL KALSELTENG</span>
                </div>
            </div>
            <div class="card-body">
                @if($o->pas_foto)
                    <div class="photo" style="background-image: url('{{ asset('storage/' . $o->pas_foto) }}');"></div>
                @else
                    <div class="photo" style="display: flex; align-items: center; justify-content: center; font-size: 10px; color: #999;">No Photo</div>
                @endif
                <div class="name">{{ $o->nama_official }}</div>
                <div class="role">OFFICIAL ({{ $o->jabatan }})</div>
                <div class="details">
                    <p><strong>SSB:</strong> {{ $team->nama_tim }}</p>
                    <p><strong>Kategori:</strong> {{ $team->kategori_usia }}</p>
                </div>
            </div>
            <div class="card-footer">
                SAH & TERVALIDASI
            </div>
        </div>
        @endforeach
    </div>

</body>
</html>