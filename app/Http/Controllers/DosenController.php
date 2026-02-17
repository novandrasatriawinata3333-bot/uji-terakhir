<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = User::with('status')->get();
        return view('home', compact('dosens'));
    }

    public function show($id)
    {
        $dosen = User::with(['jadwals' => function($query) {
            $query->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat')");
        }, 'status'])->findOrFail($id);
        
        return view('dosen.show', compact('dosen'));
    }

    public function storeBooking(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_mahasiswa' => 'required|string|max:255',
            'email_mahasiswa' => 'required|email',
            'nim_mahasiswa' => 'nullable|string|max:50',
            'tanggal_booking' => 'required|date|after:today',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'keperluan' => 'required|string',
        ]);

        $validated['user_id'] = $id;
        $validated['status'] = 'pending';

        Booking::create($validated);

        return redirect()->back()->with('success', 'Booking berhasil diajukan! Menunggu persetujuan dosen.');
    }
}
