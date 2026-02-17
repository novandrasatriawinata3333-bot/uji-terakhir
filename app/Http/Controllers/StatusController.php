<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:Ada,Mengajar,Konsultasi,Tidak Ada',
        ]);

        $user = auth()->user();
        
        if ($user->status) {
            $user->status->update([
                'status' => $validated['status'],
                'updated_at_iot' => now(),
            ]);
        } else {
            $user->status()->create([
                'status' => $validated['status'],
                'updated_at_iot' => now(),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diupdate!',
            'status' => $validated['status'],
        ]);
    }
}
