<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Berkas - Tim</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-5xl mx-auto">
        <!-- Tombol Kembali & Judul -->
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                &larr; Kembali ke Dashboard
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Pemeriksaan Berkas Tim</h1>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Informasi Utama Tim -->
        <div class="bg-white p-6 rounded-xl shadow-md mb-6">
            <h2 class="text-lg font-semibold text-red-700 mb-4 border-b pb-2">Informasi Tim / SSB</h2>
            <div class="grid grid-cols-2 gap-4 text-gray-700">
                <div>
                    <p class="text-sm text-gray-500">Nama Tim / SSB:</p>
                    <p class="font-bold text-lg">{{ $team->name ?? $team->nama_ssb ?? $team->nama_tim ?? $team->team_name ?? 'Tanpa Nama' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Kategori Usia:</p>
                    <p class="font-bold text-lg">{{ $team->category ?? $team->kategori_usia ?? $team->age_category ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status Saat Ini:</p>
                    <p class="font-bold">
                        @if(($team->status ?? '') == 'valid')
                            <span class="text-green-600 bg-green-100 px-2.5 py-1 rounded">Valid & Terverifikasi</span>
                        @else
                            <span class="text-yellow-600 bg-yellow-100 px-2.5 py-1 rounded">Menunggu Verifikasi</span>
                        @endif
                    </p>
                </div>
            </div>

            <!-- Tombol Aksi Verifikasi -->
            <div class="mt-6 border-t pt-4 flex justify-end">
                <form action="{{ route('admin.teams.verify', $team->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-600 text-white font-bold px-6 py-2 rounded-lg hover:bg-green-700 transition shadow">
                        ✅ Setujui & Nyatakan Tim Sah (Valid)
                    </button>
                </form>
            </div>
        </div>

        <!-- Daftar Pemain & Dokumen Pendukung -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Daftar Pemain & Dokumen Pendukung</h2>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
<tr class="bg-gray-200 text-gray-700 text-sm">
                        <th class="p-3 border">No</th>
                        <th class="p-3 border">Nama Lengkap Pemain</th>
                        <th class="p-3 border">NISN</th>
                        <th class="p-3 border">Foto</th>
                        <th class="p-3 border">Akte</th>
                        <th class="p-3 border">KK</th>
                        <th class="p-3 border">KIA</th>
                        <th class="p-3 border">Aksi Pemain</th>
                    </tr>                    </thead>
<tbody>
                        @isset($team->pemains)
                            @forelse($team->pemains as $i => $player)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3 border">{{ $i + 1 }}</td>
                                    <td class="p-3 border font-medium">{{ $player->name ?? $player->nama_lengkap ?? $player->nama_pemain ?? '-' }}</td>
                                    <td class="p-3 border">{{ $player->nik ?? $player->usia ?? '-' }}</td>
                                    
                                    <!-- Kolom Foto -->
                                    <td class="p-3 border text-sm">
                                        @if(!empty($player->foto))
                                            <a href="{{ asset('storage/' . $player->foto) }}" target="_blank" class="text-blue-600 hover:underline font-semibold">Lihat</a>
                                        @else
                                            <span class="text-gray-400 italic">-</span>
                                        @endif
                                    </td>

                                    <!-- Kolom Akte -->
                                    <td class="p-3 border text-sm">
                                        @if(!empty($player->akte))
                                            <a href="{{ asset('storage/' . $player->akte) }}" target="_blank" class="text-blue-600 hover:underline font-semibold">Lihat</a>
                                        @else
                                            <span class="text-gray-400 italic">-</span>
                                        @endif
                                    </td>

                                    <!-- Kolom KK -->
                                    <td class="p-3 border text-sm">
                                        @if(!empty($player->kk))
                                            <a href="{{ asset('storage/' . $player->kk) }}" target="_blank" class="text-blue-600 hover:underline font-semibold">Lihat</a>
                                        @else
                                            <span class="text-gray-400 italic">-</span>
                                        @endif
                                    </td>

                                    <!-- Kolom KIA (Opsional) -->
                                    <td class="p-3 border text-sm">
                                        @if(!empty($player->kia))
                                            <a href="{{ asset('storage/' . $player->kia) }}" target="_blank" class="text-blue-600 hover:underline font-semibold">Lihat</a>
                                        @else
                                            <span class="text-gray-400 italic">Opsional</span>
                                        @endif
                                    </td>
                                   <!-- Kolom Aksi Verifikasi Pemain -->
<td class="p-3 border text-sm">
    @if(($player->is_sah ?? 0) == 1)
        <span class="text-green-600 font-bold bg-green-100 px-2 py-1 rounded text-xs">Sah</span>
    @else
        <form action="{{ route('admin.players.verify', $player->id) }}" method="POST">
            @csrf
            <button type="submit" class="bg-blue-600 text-white text-xs px-3 py-1 rounded hover:bg-blue-700 transition">
                Setujui Pemain
            </button>
        </form>
    @endif
</td> 
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="p-4 text-center text-gray-500">Belum ada data pemain yang diunggah untuk tim ini.</td>
                                </tr>
                            @endforelse
                        @else
                            <tr>
                                <td colspan="8" class="p-4 text-center text-gray-500">Relasi data pemain belum tersedia.</td>
                            </tr>
                        @endisset
                    </tbody>
                    </html>