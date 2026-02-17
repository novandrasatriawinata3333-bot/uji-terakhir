<x-app-layout>
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="stats shadow">
                <div class="stat">
                    <div class="stat-figure text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div class="stat-title">Total Jadwal</div>
                    <div class="stat-value text-primary">{{ $totalJadwal }}</div>
                </div>
            </div>

            <div class="stats shadow">
                <div class="stat">
                    <div class="stat-figure text-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="stat-title">Pending Booking</div>
                    <div class="stat-value text-warning">{{ $pendingBooking }}</div>
                </div>
            </div>

            <div class="stats shadow">
                <div class="stat">
                    <div class="stat-figure text-success">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="stat-title">Status Saat Ini</div>
                    <div class="stat-value text-sm">{{ $currentStatus }}</div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="card-title">Jadwal Minggu Ini</h2>
                        <a href="{{ route('jadwal.create') }}" class="btn btn-primary btn-sm">+ Tambah</a>
                    </div>

                    @if($jadwalMingguIni->isEmpty())
                        <p class="text-base-content/50 italic">Belum ada jadwal</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="table table-zebra">
                                <thead>
                                    <tr>
                                        <th>Hari</th>
                                        <th>Jam</th>
                                        <th>Kegiatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jadwalMingguIni as $jadwal)
                                        <tr>
                                            <td>{{ $jadwal->hari }}</td>
                                            <td>{{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }}</td>
                                            <td><span class="badge badge-primary">{{ $jadwal->kegiatan }}</span></td>
                                            <td>
                                                <div class="flex gap-2">
                                                    <a href="{{ route('jadwal.edit', $jadwal->id) }}" class="btn btn-xs btn-warning">Edit</a>
                                                    <form method="POST" action="{{ route('jadwal.destroy', $jadwal->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-xs btn-error" onclick="return confirm('Hapus jadwal ini?')">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title mb-4">Update Status Real-Time</h2>
                    
                    <form id="statusForm" class="space-y-3">
                        @csrf
                        <div class="form-control">
                            <label class="label cursor-pointer">
                                <span class="label-text">🟢 Ada</span> 
                                <input type="radio" name="status" value="Ada" class="radio radio-success" {{ $currentStatus == 'Ada' ? 'checked' : '' }}>
                            </label>
                        </div>
                        <div class="form-control">
                            <label class="label cursor-pointer">
                                <span class="label-text">🟡 Mengajar</span> 
                                <input type="radio" name="status" value="Mengajar" class="radio radio-warning" {{ $currentStatus == 'Mengajar' ? 'checked' : '' }}>
                            </label>
                        </div>
                        <div class="form-control">
                            <label class="label cursor-pointer">
                                <span class="label-text">🔵 Konsultasi</span> 
                                <input type="radio" name="status" value="Konsultasi" class="radio radio-info" {{ $currentStatus == 'Konsultasi' ? 'checked' : '' }}>
                            </label>
                        </div>
                        <div class="form-control">
                            <label class="label cursor-pointer">
                                <span class="label-text">🔴 Tidak Ada</span> 
                                <input type="radio" name="status" value="Tidak Ada" class="radio radio-error" {{ $currentStatus == 'Tidak Ada' ? 'checked' : '' }}>
                            </label>
                        </div>
                    </form>

                    <div class="divider"></div>

                    <div class="flex flex-col gap-2">
                        <a href="{{ route('jadwal.index') }}" class="btn btn-outline btn-sm">Kelola Jadwal</a>
                        <a href="{{ route('booking.index') }}" class="btn btn-outline btn-sm">Kelola Booking</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('input[name="status"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const formData = new FormData();
                formData.append('status', this.value);
                
                fetch('{{ route('status.update') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        location.reload();
                    }
                });
            });
        });
    </script>
</x-app-layout>
