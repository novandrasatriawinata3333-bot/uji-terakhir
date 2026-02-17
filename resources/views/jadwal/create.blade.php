<x-app-layout>
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Tambah Jadwal Baru</h1>

        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <form method="POST" action="{{ route('jadwal.store') }}" class="space-y-4">
                    @csrf

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Hari</span>
                        </label>
                        <select name="hari" class="select select-bordered" required>
                            <option value="">Pilih Hari</option>
                            <option value="Senin" {{ old('hari') == 'Senin' ? 'selected' : '' }}>Senin</option>
                            <option value="Selasa" {{ old('hari') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                            <option value="Rabu" {{ old('hari') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                            <option value="Kamis" {{ old('hari') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                            <option value="Jumat" {{ old('hari') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                            <span class="label-text">Kegiatan</span>
                        </label>
                        <select name="kegiatan" class="select select-bordered" required>
                            <option value="">Pilih Kegiatan</option>
                            <option value="Mengajar" {{ old('kegiatan') == 'Mengajar' ? 'selected' : '' }}>Mengajar</option>
                            <option value="Konsultasi" {{ old('kegiatan') == 'Konsultasi' ? 'selected' : '' }}>Konsultasi</option>
                            <option value="Rapat" {{ old('kegiatan') == 'Rapat' ? 'selected' : '' }}>Rapat</option>
                            <option value="Lainnya" {{ old('kegiatan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Ruangan (Opsional)</span>
                        </label>
                        <input type="text" name="ruangan" class="input input-bordered" placeholder="Contoh: Lab 101" value="{{ old('ruangan') }}">
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Keterangan (Opsional)</span>
                        </label>
                        <textarea name="keterangan" class="textarea textarea-bordered h-24" placeholder="Detail kegiatan">{{ old('keterangan') }}</textarea>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('jadwal.index') }}" class="btn btn-ghost">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
