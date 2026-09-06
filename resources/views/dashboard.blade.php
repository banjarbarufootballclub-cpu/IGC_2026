<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Peserta / Manajer Tim') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-800">Selamat Datang, {{ Auth::user()->name }}! 👋</h3>
                    <p class="text-sm text-gray-600 mt-1">Ini adalah beranda utama untuk memantau status pendaftaran tim SSB Anda pada turnamen ini.</p>
                </div>

                @php
                    $timAktif = auth()->user()->team ?? \App\Models\Team::where('user_id', auth()->id())->first();
                    $sudahDivalidasi = $timAktif ? $timAktif->pemains()->where('is_sah', true)->exists() : false;
                @endphp

                @if(session('success'))
                    <div class="mb-4 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if(!$timAktif)
                    <!-- Belum Daftar Tim -->
                    <div class="bg-amber-50 border-l-4 border-amber-500 text-amber-800 p-4 rounded-lg mb-6">
                        <span class="font-bold">Perhatian!</span> Anda belum mendaftarkan tim SSB Anda. Silakan daftarkan tim melalui menu pendaftaran.
                    </div>

                    <div>
                        <a href="/daftar-tim" class="inline-flex items-center bg-red-700 hover:bg-red-800 text-white font-bold px-5 py-2.5 rounded-lg shadow transition text-sm">
                            ⚽ Daftarkan Tim Sekarang
                        </a>
                    </div>
                @else
                    <!-- Sudah Daftar Tim -->
                    <div class="border border-blue-200 bg-blue-50/50 rounded-xl p-6 shadow-sm">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4 pb-4 border-b border-blue-100">
                            <div>
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-1 rounded-full uppercase tracking-wider">{{ $timAktif->nama_tim ?? $timAktif->nama_ssb ?? 'Tim Terdaftar' }}</span>
                                <h4 class="text-2xl font-black text-gray-900 mt-1">{{ $timAktif->nama_team }}</h4>
                                <p class="text-xs text-gray-600 mt-0.5">Kategori Usia: <span class="font-bold text-gray-800">{{ $timAktif->kategori_usia }}</span> | Pelatih Utama: <span class="font-bold text-gray-800">{{ $timAktif->pelatih }}</span></p>
                            </div>

                            <div>
<a href="{{ route('pemain.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
    📋 Kelola Data Pemain & Official
</a>                            </div>
                        </div>

                        <!-- Status Validasi -->
                        @if($sudahDivalidasi)
                            <div class="bg-green-100 border border-green-300 text-green-800 p-4 rounded-lg mb-6 flex items-center justify-between">
                                <div>
                                    <span class="font-bold">✨ Status: Tim Sah & Terverifikasi Panitia!</span>
                                    <p class="text-xs mt-0.5">Seluruh data pemain telah diperiksa. Anda dapat mencetak lembar pengesahan dan ID Card.</p>
                                </div>
                                <span class="bg-green-600 text-white text-xs font-bold px-3 py-1 rounded-full">VALID</span>
                            </div>

                            <div class="flex flex-wrap gap-3">
                                <a href="/cetak-pengesahan/{{ $timAktif->id }}" target="_blank" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-4 py-2.5 rounded-lg shadow text-xs transition">
                                    🖨️ Cetak Pengesahan
                                </a>
                                <a href="/cetak-idcard/{{ $timAktif->id }}" target="_blank" class="bg-teal-600 hover:bg-teal-750 text-white font-bold px-4 py-2.5 rounded-lg shadow text-xs transition">
                                    🪪 Cetak ID Card
                                </a>
                                <a href="/kirim-email-berkas/{{ $timAktif->id }}" class="bg-cyan-600 hover:bg-cyan-700 text-white font-bold px-4 py-2.5 rounded-lg shadow text-xs transition">
                                    ✉️ Kirim ke Email
                                </a>
                            </div>
                        @else
                            <div class="bg-amber-100 border border-amber-300 text-amber-800 p-4 rounded-lg mb-6 flex items-center justify-between">
                                <div>
                                    <span class="font-bold">⏳ Menunggu Validasi Panitia</span>
                                    <p class="text-xs mt-0.5">Tombol cetak dan kirim email akan aktif otomatis setelah panitia memverifikasi data pemain Anda.</p>
                                </div>
                                <span class="bg-amber-500 text-white text-xs font-bold px-3 py-1 rounded-full">Dalam Antrean</span>
                            </div>

                            <div class="flex flex-wrap gap-3 opacity-50 pointer-events-none">
                                <button class="bg-gray-400 text-white font-bold px-4 py-2.5 rounded-lg text-xs cursor-not-allowed">🖨️ Cetak Pengesahan</button>
                                <button class="bg-gray-400 text-white font-bold px-4 py-2.5 rounded-lg text-xs cursor-not-allowed">🪪 Cetak ID Card</button>
                                <button class="bg-gray-400 text-white font-bold px-4 py-2.5 rounded-lg text-xs cursor-not-allowed">✉️ Kirim ke Email</button>
                            </div>
                        @endif

                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>