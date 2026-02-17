<x-app-layout>
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Edit Jadwal</h1>

        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <form method="POST" action="{{ route('jadwal.update', $jadwal->id) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Hari</span>
                        </label>
                        <select name="hari" class="select select-bordered" required>
                            <option value="Senin" {{ $jadwal->hari == 'Senin' ? 'selected' : '' }}>Senin</option>
                            <option value="Selasa" {{ $jadwal->hari == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                            <option value="Rabu" {{ $jadwal->hari == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                            <option value="Kamis" {{ $jadwal->hari == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                            <option value="Jumat" {{ $jadwal->hari == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Jam Mulai</span>
                            </label>
                            <input type="time" name="jam_mulai" class="input input-bordered" required value="{{ substr($jadwal->jam_mulai, 0, 5) }}">
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Jam Selesai</span>
                            </label>
                            <input type="time" name="jam_selesai" class="input input-bordered" required value="{{ substr($jadwal->jam_selesai, 0, 5) }}">
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Kegiatan</span>
                        </label>
                        <select name="kegiatan" class="select select-bordered" required>
                            <option value="Mengajar" {{ $jadwal->kegiatan == 'Mengajar' ? 'selected' : '' }}>Mengajar</option>
                            <option value="Konsultasi" {{ $jadwal->kegiatan == 'Konsultasi' ? 'selected' : '' }}>Konsultasi</option>
                            <option value="Rapat" {{ $jadwal->kegiatan == 'Rapat' ? 'selected' : '' }}>Rapat</option>
                            <option value="Lainnya" {{ $jadwal->kegiatan == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Ruangan</span>
                        </label>
                        <input type="text" name="ruangan" class="input input-bordered" value="{{ $jadwal->ruangan }}">
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Keterangan</span>
                        </label>
                        <textarea name="keterangan" class="textarea textarea-bordered h-24">{{ $jadwal->keterangan }}</textarea>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('jadwal.index') }}" class="btn btn-ghost">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
