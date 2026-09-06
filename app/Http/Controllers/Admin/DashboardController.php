<?php

namespace App\Http\Controllers\Admin;
use App\Models\Pemain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;

class DashboardController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        return view('admin.dashboard', compact('teams'));
    }

    public function show($id)
    {
        $team = Team::with('players')->findOrFail($id); // Mengambil data tim beserta relasi pemain
        return view('admin.teams.show', compact('team'));
    }

    public function verify(Request $request, $id)
    {
        $team = Team::findOrFail($id);
        $team->status = 'valid'; // Ubah status menjadi valid/sah
        $team->save();

        return back()->with('success', 'Berkas tim berhasil diverifikasi dan dinyatakan sah!');
    }
    public function verifyPlayer($id)
{
    $player = Pemain::findOrFail($id);
    $player->is_sah = 1; // Ubah status pemain menjadi sah (1)
    $player->save();

    return back()->with('success', 'Pemain berhasil disahkan!');
}
}