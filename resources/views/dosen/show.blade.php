<x-app-layout>
    <div class="max-w-5xl mx-auto">
        <div class="card bg-base-100 shadow-xl mb-6">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="avatar placeholder">
                            <div class="bg-primary text-primary-content rounded-full w-20">
                                <span class="text-3xl font-bold">{{ substr($dosen->name, 0, 1) }}</span>
                            </div>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold">{{ $dosen->name }}</h1>
                            <p class="text-base-content/70">{{ $dosen->role }} | NIP: {{ $dosen->nip }}</p>
                        </div>
                    </div>
                    @php
                        $statusColors = [
                            'Ada' => 'badge-success',
                            'Mengajar' => 'badge-warning',
                            'Konsultasi' => 'badge-info',
                            'Tidak Ada' => 'badge-error'
                        ];
                        $currentStatus = $dosen->status->status ?? 'Tidak Ada';
                    @endphp
                    <div class="badge {{ $statusColors[$currentStatus] }} badge-lg">
                        {{ $currentStatus }}
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl mb-6">
            <div class="card-body">
                <h2 class="card-title text-2xl mb-4">📅 Jadwal Mingguan</h2>
                
                @php
                    $jadwalByHari = $dosen->jadwals->groupBy('hari');
                    $hariOrder = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
                @endphp

                <div class="space-y-4">
                    @foreach($hariOrder as $hari)
                        <div class="collapse collapse-arrow bg-base-200">
                            <input type="checkbox" {{ $jadwalByHari->has($hari) ? 'checked' : '' }} /> 
                            <div class="collapse-title text-xl font-medium">
                                {{ $hari }}
                                @if($jadwalByHari->has($hari))
                                    <span class="badge badge-primary ml-2">{{ $jadwalByHari[$hari]->count() }} kegiatan</span>
                                @endif
                            </div>
                            <div class="collapse-content">
                                @if($jadwalByHari->has($hari))
                                    <div class="space-y-2">
                                        @foreach($jadwalByHari[$hari] as $jadwal)
                                            <div class="card bg-base-100 shadow-sm">
                                                <div class="card-body p-4">
                                                    <div class="flex items-center gap-3">
                                                        <div class="badge badge-primary">
                                                            {{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }}
                                                        </div>
                                                        <div class="badge badge-secondary">{{ $jadwal->kegiatan }}</div>
                                                        @if($jadwal->ruangan)
                                                            <span class="text-sm">📍 {{ $jadwal->ruangan }}</span>
                                                        @endif
                                                    </div>
                                                    @if($jadwal->keterangan)
                                                        <p class="text-sm text-base-content/70 mt-2">{{ $jadwal->keterangan }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-base-content/50 italic">Tidak ada jadwal</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div id="booking" class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title text-2xl mb-4">📝 Booking Konsultasi</h2>
                
                <form method="POST" action="{{ route('dosen.booking', $dosen->id) }}" class="space-y-4">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Nama Lengkap</span>
                            </label>
                            <input type="text" name="nama_mahasiswa" class="input input-bordered" required value="{{ old('nama_mahasiswa') }}">
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Email</span>
                            </label>
                            <input type="email" name="email_mahasiswa" class="input input-bordered" required value="{{ old('email_mahasiswa') }}">
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">NIM (Opsional)</span>
                        </label>
                        <input type="text" name="nim_mahasiswa" class="input input-bordered" value="{{ old('nim_mahasiswa') }}">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Tanggal Booking</span>
                            </label>
                            <input type="date" name="tanggal_booking" class="input input-bordered" required 
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}" value="{{ old('tanggal_booking') }}">
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Jam Mulai</span>
                            </label>
                            <input type="time" name="jam_mulai" class="input input-bordered" required value="{{ old('jam_mulai') }}">
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Jam Selesai</span>
                            </label>
                            <input type="time" name="jam_selesai" class="input input-bordered" required value="{{ old('jam_selesai') }}">
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Keperluan</span>
                        </label>
                        <textarea name="keperluan" class="textarea textarea-bordered h-24" required>{{ old('keperluan') }}</textarea>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="btn btn-primary">Kirim Booking</button>
                        <a href="{{ route('home') }}" class="btn btn-ghost">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
