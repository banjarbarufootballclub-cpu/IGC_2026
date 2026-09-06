<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Verifikasi Panitia Pusat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="bg-white p-6 rounded-xl shadow-md flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-red-700">Dashboard Panitia Pusat 🚀</h1>
                <p class="text-gray-600">Panel verifikasi berkas dan pengelolaan tim peserta turnamen.</p>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                    Logout Admin
                </button>
            </form>
        </div>

        <!-- Tabel Daftar Tim / Verifikasi Berkas -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Daftar Tim & Verifikasi Berkas</h2>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="p-3 border">No</th>
                            <th class="p-3 border">Nama Tim / SSB</th>
                            <th class="p-3 border">Kategori Usia</th>
                            <th class="p-3 border">Status Berkas</th>
                            <th class="p-3 border text-center">Aksi / Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($teams as $index => $team)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 border">{{ $index + 1 }}</td>
                                <td class="p-3 border font-medium">{{ $team->name ?? $team->nama_tim ?? $team->team_name ?? $team->nama_ssb ?? $team->school_name ?? 'Tim Tanpa Nama' }}</td>
                                <td class="p-3 border">{{ $team->category ?? $team->kategori_usia ?? $team->age_category }}</td>
                                <td class="p-3 border">
                                    @if(($team->status ?? '') == 'valid')
                                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">Valid / Sah</span>
                                    @else
                                        <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded">Menunggu Verifikasi</span>
                                    @endif
                                </td>
                                <td class="p-3 border text-center">
                                    <a href="{{ route('admin.teams.show', $team->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition">Periksa Berkas</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-4 text-center text-gray-500">Belum ada tim peserta yang mendaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>