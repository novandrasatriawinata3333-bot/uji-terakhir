<x-app-layout>
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Kelola Jadwal</h1>
            <a href="{{ route('jadwal.create') }}" class="btn btn-primary">+ Tambah Jadwal</a>
        </div>

        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                @if($jadwals->isEmpty())
                    <p class="text-center text-base-content/50 italic py-8">Belum ada jadwal. Tambahkan jadwal pertama Anda!</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="table table-zebra">
                            <thead>
                                <tr>
                                    <th>Hari</th>
                                    <th>Jam</th>
                                    <th>Kegiatan</th>
                                    <th>Ruangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jadwals as $jadwal)
                                    <tr>
                                        <td><strong>{{ $jadwal->hari }}</strong></td>
                                        <td>{{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }}</td>
                                        <td><span class="badge badge-primary">{{ $jadwal->kegiatan }}</span></td>
                                        <td>{{ $jadwal->ruangan ?? '-' }}</td>
                                        <td>
                                            <div class="flex gap-2">
                                                <a href="{{ route('jadwal.edit', $jadwal->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                <form method="POST" action="{{ route('jadwal.destroy', $jadwal->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-error" onclick="return confirm('Hapus jadwal ini?')">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $jadwals->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
