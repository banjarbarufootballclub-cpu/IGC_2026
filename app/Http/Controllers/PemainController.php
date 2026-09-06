<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemain;
use App\Models\Official;
use App\Models\Team;
use Illuminate\Support\Facades\Storage;

class PemainController extends Controller
{
    public function index()
    {
        $team = Team::where('user_id', auth()->id())->first();
        $pemains = $team ? Pemain::where('team_id', $team->id)->get() : collect();
        $officials = $team ? Official::where('team_id', $team->id)->get() : collect();
        
        return view('Pemain.index', compact('team', 'pemains', 'officials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemain' => 'required|string|max:255',
            'nisn' => 'required|string|max:50',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nomor_punggung' => 'nullable|integer',
            'foto' => 'required|image|max:2048',
            'akte' => 'required|file|mimes:pdf,jpg,png|max:2048',
            'kk' => 'required|file|mimes:pdf,jpg,png|max:2048',
            'kia' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $team = Team::where('user_id', auth()->id())->first();
        if (!$team) return redirect()->back()->withErrors(['error' => 'Silakan daftarkan tim terlebih dahulu.']);

        Pemain::create([
            'team_id' => $team->id,
            'nama_pemain' => $request->nama_pemain,
            'nisn' => $request->nisn,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nomor_punggung' => $request->nomor_punggung,
            'foto' => $request->file('foto')->store('pemain/foto', 'public'),
            'akte' => $request->file('akte')->store('pemain/akte', 'public'),
            'kk' => $request->file('kk')->store('pemain/kk', 'public'),
            'kia' => $request->hasFile('kia') ? $request->file('kia')->store('pemain/kia', 'public') : null,
        ]);

        return redirect()->back()->with('success', 'Data pemain berhasil ditambahkan!');
    }

    public function storeOfficial(Request $request)
    {
        $request->validate([
            'nama_official' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'required|image|max:2048',
            'lisensi_ktp' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $team = Team::where('user_id', auth()->id())->first();
        if (!$team) return redirect()->back()->withErrors(['error' => 'Silakan daftarkan tim terlebih dahulu.']);

        Official::create([
            'team_id' => $team->id,
            'nama_official' => $request->nama_official,
            'jabatan' => $request->jabatan,
            'foto' => $request->file('foto')->store('official/foto', 'public'),
            'lisensi_ktp' => $request->file('lisensi_ktp')->store('official/ktp', 'public'),
        ]);

        return redirect()->back()->with('success', 'Data official berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $pemain = Pemain::findOrFail($id);
        foreach(['foto', 'akte', 'kk', 'kia'] as $col) {
            if($pemain->$col) Storage::disk('public')->delete($pemain->$col);
        }
        $pemain->delete();
        return back()->with('success', 'Pemain berhasil dihapus.');
    }

    public function destroyOfficial($id)
    {
        $official = Official::findOrFail($id);
        foreach(['foto', 'lisensi_ktp'] as $col) {
            if($official->$col) Storage::disk('public')->delete($official->$col);
        }
        $official->delete();
        return back()->with('success', 'Official berhasil dihapus.');
    }
}