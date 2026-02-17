<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = auth()->user()->bookings();

        if ($request->has('filter') && $request->filter !== 'all') {
            $query->where('status', $request->filter);
        }

        $bookings = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('booking.index', compact('bookings'));
    }

    public function approve($id)
    {
        $booking = Booking::findOrFail($id);
        $this->authorize('update', $booking);

        $booking->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Booking berhasil disetujui!');
    }

    public function reject(Request $request, $id)
    {
        $validated = $request->validate([
            'alasan_reject' => 'required|string',
        ]);

        $booking = Booking::findOrFail($id);
        $this->authorize('update', $booking);

        $booking->update([
            'status' => 'rejected',
            'alasan_reject' => $validated['alasan_reject'],
        ]);

        return redirect()->back()->with('success', 'Booking berhasil ditolak!');
    }
}
