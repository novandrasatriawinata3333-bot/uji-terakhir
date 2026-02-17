<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Jadwal;
use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Dosen 1: Dr. Budi Santoso (Kepala Lab)
        $budi = User::create([
            'name' => 'Dr. Budi Santoso',
            'email' => 'budi@lab-wicida.ac.id',
            'password' => Hash::make('password'),
            'nip' => '198501151990031001',
            'role' => 'kepala_lab',
        ]);

        Status::create([
            'user_id' => $budi->id,
            'status' => 'Ada',
        ]);

        Jadwal::create([
            'user_id' => $budi->id,
            'hari' => 'Senin',
            'jam_mulai' => '08:00',
            'jam_selesai' => '10:00',
            'ruangan' => 'Lab 101',
            'kegiatan' => 'Mengajar',
            'keterangan' => 'Praktikum Algoritma',
        ]);

        Jadwal::create([
            'user_id' => $budi->id,
            'hari' => 'Selasa',
            'jam_mulai' => '13:00',
            'jam_selesai' => '15:00',
            'ruangan' => 'Ruang Dosen',
            'kegiatan' => 'Konsultasi',
            'keterangan' => 'Konsultasi mahasiswa bimbingan',
        ]);

        Jadwal::create([
            'user_id' => $budi->id,
            'hari' => 'Rabu',
            'jam_mulai' => '09:00',
            'jam_selesai' => '11:00',
            'ruangan' => 'Ruang Rapat',
            'kegiatan' => 'Rapat',
            'keterangan' => 'Rapat koordinasi lab',
        ]);

        // Create Dosen 2: Ir. Siti Nurhayati
        $siti = User::create([
            'name' => 'Ir. Siti Nurhayati',
            'email' => 'siti@lab-wicida.ac.id',
            'password' => Hash::make('password'),
            'nip' => '198703202015032004',
            'role' => 'staf',
        ]);

        Status::create([
            'user_id' => $siti->id,
            'status' => 'Mengajar',
        ]);

        Jadwal::create([
            'user_id' => $siti->id,
            'hari' => 'Senin',
            'jam_mulai' => '10:00',
            'jam_selesai' => '12:00',
            'ruangan' => 'Lab 102',
            'kegiatan' => 'Mengajar',
            'keterangan' => 'Praktikum Basis Data',
        ]);

        Jadwal::create([
            'user_id' => $siti->id,
            'hari' => 'Kamis',
            'jam_mulai' => '14:00',
            'jam_selesai' => '16:00',
            'ruangan' => 'Ruang Dosen',
            'kegiatan' => 'Konsultasi',
            'keterangan' => 'Open consultation',
        ]);

        // Create Dosen 3: Andriana Kusuma
        $andriana = User::create([
            'name' => 'Andriana Kusuma',
            'email' => 'andriana@lab-wicida.ac.id',
            'password' => Hash::make('password'),
            'nip' => '199005152018032002',
            'role' => 'staf',
        ]);

        Status::create([
            'user_id' => $andriana->id,
            'status' => 'Konsultasi',
        ]);

        Jadwal::create([
            'user_id' => $andriana->id,
            'hari' => 'Selasa',
            'jam_mulai' => '08:00',
            'jam_selesai' => '10:00',
            'ruangan' => 'Lab 103',
            'kegiatan' => 'Mengajar',
            'keterangan' => 'Praktikum Web Programming',
        ]);

        Jadwal::create([
            'user_id' => $andriana->id,
            'hari' => 'Jumat',
            'jam_mulai' => '13:00',
            'jam_selesai' => '15:00',
            'ruangan' => 'Ruang Dosen',
            'kegiatan' => 'Konsultasi',
            'keterangan' => 'Bimbingan skripsi',
        ]);
    }
}
