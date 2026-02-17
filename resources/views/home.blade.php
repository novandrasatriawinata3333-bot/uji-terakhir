<x-app-layout>
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-primary mb-2">Jadwal Dosen Lab WICIDA</h1>
        <p class="text-lg text-base-content/70">Transparansi jadwal real-time dan booking konsultasi</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($dosens as $dosen)
            @php
                $statusColors = [
                    'Ada' => 'badge-success',
                    'Mengajar' => 'badge-warning',
                    'Konsultasi' => 'badge-info',
                    'Tidak Ada' => 'badge-error'
                ];
                $statusEmoji = [
                    'Ada' => '🟢',
                    'Mengajar' => '🟡',
                    'Konsultasi' => '🔵',
                    'Tidak Ada' => '🔴'
                ];
                $currentStatus = $dosen->status->status ?? 'Tidak Ada';
            @endphp

            <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow">
                <div class="card-body">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="avatar placeholder">
                            <div class="bg-primary text-primary-content rounded-full w-16">
                                <span class="text-2xl font-bold">{{ substr($dosen->name, 0, 1) }}</span>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h2 class="card-title text-xl">{{ $dosen->name }}</h2>
                            <p class="text-sm text-base-content/70">NIP: {{ $dosen->nip }}</p>
                            <div class="badge {{ $statusColors[$currentStatus] }} badge-sm mt-1">
                                {{ $statusEmoji[$currentStatus] }} {{ $currentStatus }}
                            </div>
                        </div>
                    </div>

                    <div class="divider my-2"></div>

                    <div class="flex flex-col gap-2">
                        <a href="{{ route('dosen.show', $dosen->id) }}" class="btn btn-primary btn-sm">
                            📅 Lihat Jadwal
                        </a>
                        <a href="{{ route('dosen.show', $dosen->id) }}#booking" class="btn btn-outline btn-sm">
                            📝 Booking Konsultasi
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
