<x-app-layout>
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Kelola Booking Konsultasi</h1>

        <div class="tabs tabs-boxed mb-6">
            <a href="{{ route('booking.index') }}" class="tab {{ !request('filter') || request('filter') == 'all' ? 'tab-active' : '' }}">Semua</a>
            <a href="{{ route('booking.index', ['filter' => 'pending']) }}" class="tab {{ request('filter') == 'pending' ? 'tab-active' : '' }}">Menunggu</a>
            <a href="{{ route('booking.index', ['filter' => 'approved']) }}" class="tab {{ request('filter') == 'approved' ? 'tab-active' : '' }}">Disetujui</a>
            <a href="{{ route('booking.index', ['filter' => 'rejected']) }}" class="tab {{ request('filter') == 'rejected' ? 'tab-active' : '' }}">Ditolak</a>
        </div>

        @if($bookings->isEmpty())
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <p class="text-center text-base-content/50 italic py-8">Belum ada booking</p>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 gap-4">
                @foreach($bookings as $booking)
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h3 class="font-bold text-lg">{{ $booking->nama_mahasiswa }}</h3>
                                    <p class="text-sm text-base-content/70">{{ $booking->email_mahasiswa }}</p>
                                    @if($booking->nim_mahasiswa)
                                        <p class="text-sm text-base-content/70">NIM: {{ $booking->nim_mahasiswa }}</p>
                                    @endif
                                </div>
                                <div class="badge {{ $booking->status == 'pending' ? 'badge-warning' : ($booking->status == 'approved' ? 'badge-success' : 'badge-error') }} badge-lg">
                                    {{ ucfirst($booking->status) }}
                                </div>
                            </div>

                            <div class="divider my-2"></div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-semibold">Tanggal & Waktu:</p>
                                    <p>📅 {{ $booking->tanggal_booking->format('d M Y') }}</p>
                                    <p>⏰ {{ substr($booking->jam_mulai, 0, 5) }} - {{ substr($booking->jam_selesai, 0, 5) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold">Keperluan:</p>
                                    <p class="text-sm">{{ $booking->keperluan }}</p>
                                </div>
                            </div>

                            @if($booking->status == 'rejected' && $booking->alasan_reject)
                                <div class="alert alert-error mt-4">
                                    <span><strong>Alasan Penolakan:</strong> {{ $booking->alasan_reject }}</span>
                                </div>
                            @endif

                            @if($booking->status == 'pending')
                                <div class="card-actions justify-end mt-4">
                                    <form method="POST" action="{{ route('booking.approve', $booking->id) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">✓ Setujui</button>
                                    </form>
                                    <button onclick="rejectModal{{ $booking->id }}.showModal()" class="btn btn-error btn-sm">✗ Tolak</button>
                                </div>

                                <dialog id="rejectModal{{ $booking->id }}" class="modal">
                                    <div class="modal-box">
                                        <h3 class="font-bold text-lg">Tolak Booking</h3>
                                        <form method="POST" action="{{ route('booking.reject', $booking->id) }}" class="py-4">
                                            @csrf
                                            <div class="form-control">
                                                <label class="label">
                                                    <span class="label-text">Alasan Penolakan</span>
                                                </label>
                                                <textarea name="alasan_reject" class="textarea textarea-bordered h-24" required placeholder="Jelaskan alasan penolakan..."></textarea>
                                            </div>
                                            <div class="modal-action">
                                                <button type="submit" class="btn btn-error">Tolak Booking</button>
                                                <button type="button" class="btn" onclick="rejectModal{{ $booking->id }}.close()">Batal</button>
                                            </div>
                                        </form>
                                    </div>
                                </dialog>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $bookings->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
