<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <h2 class="text-xl font-bold text-gray-800 mb-6">Kelola Data Pemain & Official</h2>

                <!-- Tampilkan Pesan Error Validasi -->
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <strong class="font-bold">Terjadi kesalahan!</strong>
                        <ul class="mt-1 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Pesan Sukses -->
                @if (session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Form Tambah Pemain Baru -->
                <div class="mb-8 border-b pb-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">+ Tambah Pemain Baru</h3>
                    
                    <form action="{{ route('pemain.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block font-medium text-xs text-gray-700 uppercase">Nama Pemain</label>
                                <input type="text" name="nama_pemain" value="{{ old('nama_pemain') }}" class="w-full border border-gray-300 rounded-md p-2 mt-1 text-sm" placeholder="Nama Lengkap" required>
                            </div>

                            <div>
                                <label class="block font-medium text-xs text-gray-700 uppercase">NISN / NIK</label>
                                <input type="text" name="nisn" value="{{ old('nisn') }}" class="w-full border border-gray-300 rounded-md p-2 mt-1 text-sm" placeholder="Nomor NISN/NIK" required>
                            </div>

                            <div>
                                <label class="block font-medium text-xs text-gray-700 uppercase">Nomor Punggung</label>
                                <input type="number" name="nomor_punggung" value="{{ old('nomor_punggung') }}" class="w-full border border-gray-300 rounded-md p-2 mt-1 text-sm" placeholder="10">
                            </div>

                            <div>
                                <label class="block font-medium text-xs text-gray-700 uppercase">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" class="w-full border border-gray-300 rounded-md p-2 mt-1 text-sm" placeholder="Kota Kelahiran" required>
                            </div>

                            <div>
                                <label class="block font-medium text-xs text-gray-700 uppercase">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="w-full border border-gray-300 rounded-md p-2 mt-1 text-sm" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">
                            <div>
                                <label class="block font-medium text-xs text-gray-700 uppercase">Pas Foto (Max 2MB)</label>
                                <input type="file" name="foto" class="w-full border border-gray-300 rounded-md p-1 mt-1 text-sm" required>
                            </div>
                            <div>
                                <label class="block font-medium text-xs text-gray-700 uppercase">Akte Kelahiran</label>
                                <input type="file" name="akte" class="w-full border border-gray-300 rounded-md p-1 mt-1 text-sm" required>
                            </div>
                            <div>
                                <label class="block font-medium text-xs text-gray-700 uppercase">Kartu Keluarga (KK)</label>
                                <input type="file" name="kk" class="w-full border border-gray-300 rounded-md p-1 mt-1 text-sm" required>
                            </div>
                            <div>
                                <label class="block font-medium text-xs text-gray-700 uppercase">KIA (Opsi)</label>
                                <input type="file" name="kia" class="w-full border border-gray-300 rounded-md p-1 text-sm">
                            </div>
                        </div>

                        <div class="flex justify-end mt-4">
                            <button type="submit" class="bg-gray-900 hover:bg-gray-800 text-white px-4 py-2 rounded-md text-sm font-semibold">Simpan Pemain</button>
                        </div>
                    </form>
                </div>

                <!-- Daftar Skuad Pemain -->
                <div class="mb-10">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">📋 Daftar Skuad Pemain</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 border">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Foto</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama Pemain</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No. Punggung</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">TTL</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 text-sm">
                                @forelse($pemains as $p)
                                    <tr>
                                        <td class="px-4 py-2">
                                            @if($p->foto)
                                                <img src="{{ asset('storage/' . $p->foto) }}" class="w-10 h-10 object-cover rounded-full">
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 font-medium text-gray-900">{{ $p->nama_pemain }}</td>
                                        <td class="px-4 py-2">{{ $p->nomor_punggung ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $p->tempat_lahir }}, {{ $p->tanggal_lahir }}</td>
                                        <td class="px-4 py-2">
                                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                                        </td>
                                        <td class="px-4 py-2 text-center">
                                            <form action="{{ route('pemain.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pemain ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 text-xs font-bold">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-4 text-center text-gray-500 text-sm">Belum ada pemain yang didaftarkan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Form Tambah Official Tim -->
                <div class="border-t pt-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">+ Tambah Official Tim (Pelatih/Manajer)</h3>
                    
                    <form action="{{ route('official.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <label class="block font-medium text-xs text-gray-700 uppercase">Nama Official</label>
                                <input type="text" name="nama_official" value="{{ old('nama_official') }}" class="w-full border border-gray-300 rounded-md p-2 mt-1 text-sm" placeholder="Nama Lengkap & Gelar" required>
                            </div>
                            <div>
                                <label class="block font-medium text-xs text-gray-700 uppercase">Jabatan</label>
                                <select name="jabatan" class="w-full border border-gray-300 rounded-md p-2 mt-1 text-sm" required>
                                    <option value="Pelatih Kepala">Pelatih Kepala</option>
                                    <option value="Asisten Pelatih">Asisten Pelatih</option>
                                    <option value="Manajer Tim">Manajer Tim</option>
                                    <option value="Official">Official Lainnya</option>
                                </select>
                            </div>
                            <div>
                                <label class="block font-medium text-xs text-gray-700 uppercase">Pas Foto (Max 2MB)</label>
                                <input type="file" name="foto" class="w-full border border-gray-300 rounded-md p-1 mt-1 text-sm" required>
                            </div>
                            <div>
                                <label class="block font-medium text-xs text-gray-700 uppercase">Lisensi / KTP</label>
                                <input type="file" name="lisensi_ktp" class="w-full border border-gray-300 rounded-md p-1 mt-1 text-sm" required>
                            </div>
                        </div>
                        <div class="flex justify-end mt-4">
                            <button type="submit" class="bg-gray-900 hover:bg-gray-800 text-white px-4 py-2 rounded-md text-sm font-semibold">Simpan Official</button>
                        </div>
                    </form>
                </div>

                <!-- Daftar Official Tim -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">📋 Daftar Official Tim</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 border">
<table class="min-w-full divide-y divide-gray-200 border">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Foto</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama Official</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jabatan</th>
            <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
            <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200 text-sm">
        @forelse($officials as $o)
            <tr>
                <td class="px-4 py-2">
                    @if($o->foto)
                        <img src="{{ asset('storage/' . $o->foto) }}" class="w-10 h-10 object-cover rounded-full">
                    @else
                        -
                    @endif
                </td>
                <td class="px-4 py-2">{{ $o->nama }}</td>
                <td class="px-4 py-2">{{ $o->jabatan }}</td>
                <td class="px-4 py-2 text-center">
                    @if(isset($o->is_sah) && $o->is_sah == 1)
                        <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full font-semibold">Sah</span>
                    @else
                        <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full font-semibold">Menunggu</span>
                    @endif
                </td>
                <td class="px-4 py-2 text-center">
                    <form action="{{ route('official.destroy', $o->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus official ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="px-4 py-4 text-center text-gray-500">Belum ada official.</td>
            </tr>
        @endforelse
    </tbody>
</table>
               </x-app-layout>