<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Pemain;
use App\Models\Official;

class AdminController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/dashboard');
        }

        $semuaTim = Team::with(['pemains', 'officials'])->get();

        return view('admin.dashboard', compact('semuaTim'));
    }

    public function sahkanPemain($id)
    {
        $pemain = Pemain::findOrFail($id);
        $pemain->is_sah = !$pemain->is_sah; // Toggle (kalau sah jadi pending, kalau pending jadi sah)
        $pemain->save();

        return redirect()->back();
    }

    public function sahkanOfficial($id)
    {
        $official = Official::findOrFail($id);
        $official->is_sah = !$official->is_sah; // Toggle status
        $official->save();

        return redirect()->back();
    }
}