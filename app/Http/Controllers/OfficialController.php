<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Official;
use App\Models\Team;
use Illuminate\Support\Facades\Storage;

class OfficialController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_official' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'required|image|max:2048',
            'lisensi_ktp' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $team = Team::where('user_id', auth()->id())->first();

        if (!$team) {
            return redirect()->back()->withErrors(['error' => 'Silakan daftarkan tim terlebih dahulu.']);
        }

        $fotoPath = $request->file('foto')->store('official/foto', 'public');
        $ktpPath = $request->file('lisensi_ktp')->store('official/ktp', 'public');

        Official::create([
            'team_id' => $team->id,
            'nama_official' => $request->nama_official,
            'jabatan' => $request->jabatan,
            'foto' => $fotoPath,
            'lisensi_ktp' => $ktpPath,
        ]);

        return redirect()->back()->with('success', 'Data official berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $official = Official::findOrFail($id);
        
        if ($official->foto) {
            Storage::disk('public')->delete($official->foto);
        }
        if ($official->lisensi_ktp) {
            Storage::disk('public')->delete($official->lisensi_ktp);
        }

        $official->delete();

        return back()->with('success', 'Official berhasil dihapus.');
    }
}