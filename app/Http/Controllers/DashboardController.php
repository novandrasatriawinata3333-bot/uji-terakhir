<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $totalJadwal = $user->jadwals()->count();
        $pendingBooking = $user->bookings()->where('status', 'pending')->count();
        $currentStatus = $user->status->status ?? 'Tidak Ada';
        
        $jadwalMingguIni = $user->jadwals()
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat')")
            ->get();

        return view('dashboard', compact('totalJadwal', 'pendingBooking', 'currentStatus', 'jadwalMingguIni'));
    }
}
