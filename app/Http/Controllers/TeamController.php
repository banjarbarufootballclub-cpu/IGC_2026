<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function simpan(Request $request)
    {
        // Siapkan variabel kosong untuk logo
        $logoPath = null;

        // Cek apakah user mengunggah file logo
        if ($request->hasFile('logo')) {
            // Simpan gambar ke folder 'storage/app/public/logos'
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        // Menyimpan data dari form ke database
        Team::create([
            'user_id' => Auth::id(),
            'nama_ssb' => $request->nama_ssb,
            'logo' => $logoPath, // Menyimpan nama jalur file logonya
            'kategori_usia' => $request->kategori_usia,
            'nama_pelatih' => $request->nama_pelatih,
        ]);

        // Mengembalikan ke halaman dashboard setelah sukses
        return redirect()->back();
    }
    public function cetakPengesahan($teamId)
    {
        $tim = Team::with(['pemains' => function($q) {
            $q->where('is_sah', true);
        }, 'officials' => function($q) {
            $q->where('is_sah', true);
        }])->findOrFail($teamId);

        return view('cetak.pengesahan', compact('tim'));
    }
    public function cetakIdCard($teamId)
    {
        $tim = Team::with(['pemains' => function($q) {
            $q->where('is_sah', true);
        }, 'officials' => function($q) {
            $q->where('is_sah', true);
        }])->findOrFail($teamId);

        return view('cetak.idcard', compact('tim'));
    }
    public function kirimEmailBerkas($teamId)
    {
        $tim = Team::with('user', 'pemains', 'officials')->findOrFail($teamId);
        
        // Pastikan email usernya ada
        if ($tim->user && $tim->user->email) {
            \Illuminate\Support\Facades\Mail::raw("Halo Manajer {$tim->nama_ssb},\n\nBerkas lembar pengesahan dan ID Card peserta turnamen Anda dapat diakses melalui link berikut:\n\n- Lembar Pengesahan: " . url('/cetak-pengesahan/' . $tim->id) . "\n- ID Card Peserta: " . url('/cetak-idcard/' . $tim->id) . "\n\nTerima kasih,\nPanitia Turnamen", function ($message) use ($tim) {
                $message->to($tim->user->email)
                        ->subject('Berkas Resmi & ID Card Tim - ' . $tim->nama_ssb);
            });
        }

        return back()->with('success', 'Berkas berhasil dikirim ke email Anda!');
    }
    public function create()
{
    return view('daftar-tim');
}

public function store(Request $request)
{
    $request->validate([
        'nama_ssb' => 'required|string|max:255',
        'kategori_usia' => 'required|string|max:50',
        'nama_pelatih' => 'required|string|max:255',
    ]);

    Team::create([
        'user_id' => auth()->id(),
        'nama_ssb' => $request->nama_ssb,
        'kategori_usia' => $request->kategori_usia,
        'nama_pelatih' => $request->nama_pelatih,
    ]);

    return redirect('/dashboard')->with('success', 'Tim SSB berhasil didaftarkan!');
}
}