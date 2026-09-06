<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pendaftaran Tim SSB') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="/daftar-tim">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Nama SSB / Klub</label>
                        <input type="text" name="nama_ssb" class="w-full border-gray-300 rounded-md shadow-sm mt-1" required placeholder="Contoh: SSB Garuda">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Kategori Usia</label>
                        <select name="kategori_usia" class="w-full border-gray-300 rounded-md shadow-sm mt-1" required>
                            <option value="U-10">U-10</option>
                            <option value="U-12">U-12</option>
                            <option value="U-14">U-14</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Nama Pelatih Utama</label>
                        <input type="text" name="nama_pelatih" class="w-full border-gray-300 rounded-md shadow-sm mt-1" required placeholder="Contoh: Coach Budi">
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-bold px-6 py-2.5 rounded-lg shadow transition">
                            Simpan & Daftarkan Tim
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>