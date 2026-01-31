<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Akreditasi;

class AkreditasiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_program_studi' => 'Teknik Informatika',
                'jenjang' => 'S1',
                'tahun' => 2025,
                'nilai' => 'Baik',
                'keterangan' => 'Ada di Uncen, Unipa, dan UPSL',
            ],
            [
                'nama_program_studi' => 'Teknik Sipil',
                'jenjang' => 'S1',
                'tahun' => 2025,
                'nilai' => 'Baik',
                'keterangan' => 'Dibuka di Uncen dan beberapa PTS di Papua',
            ],
            [
                'nama_program_studi' => 'Kesehatan Masyarakat',
                'jenjang' => 'S1',
                'tahun' => 2025,
                'nilai' => 'Baik',
                'keterangan' => 'Ada di Uncen, Unmus, dan Poltekkes',
            ],
            [
                'nama_program_studi' => 'Keperawatan',
                'jenjang' => 'S1',
                'tahun' => 2025,
                'nilai' => 'Baik',
                'keterangan' => 'Banyak dibuka, termasuk di Uncen',
            ],
            [
                'nama_program_studi' => 'Pendidikan Dokter',
                'jenjang' => 'S1',
                'tahun' => 2025,
                'nilai' => 'Baik',
                'keterangan' => 'Dibuka oleh Uncen, kini jadi rujukan',
            ],
            [
                'nama_program_studi' => 'Pendidikan Guru Sekolah Dasar (PGSD)',
                'jenjang' => 'S1',
                'tahun' => 2025,
                'nilai' => 'Baik',
                'keterangan' => 'Jurusan paling banyak diminati di Papua',
            ],
            [
                'nama_program_studi' => 'Pendidikan Matematika',
                'jenjang' => 'S1',
                'tahun' => 2025,
                'nilai' => 'Baik',
                'keterangan' => 'Ada di Uncen dan Unipa',
            ],
            [
                'nama_program_studi' => 'Pendidikan Bahasa Indonesia',
                'jenjang' => 'S1',
                'tahun' => 2025,
                'nilai' => 'Baik',
                'keterangan' => 'Umum dibuka di kampus Papua',
            ],
            [
                'nama_program_studi' => 'Ilmu Komunikasi',
                'jenjang' => 'S1',
                'tahun' => 2025,
                'nilai' => 'Baik',
                'keterangan' => 'Ada di Uncen dan beberapa PTS',
            ],
            [
                'nama_program_studi' => 'Administrasi Publik',
                'jenjang' => 'S1',
                'tahun' => 2025,
                'nilai' => 'Baik',
                'keterangan' => 'Relevan untuk birokrasi di Papua',
            ],
            [
                'nama_program_studi' => 'Hubungan Internasional',
                'jenjang' => 'S1',
                'tahun' => 2025,
                'nilai' => 'Baik',
                'keterangan' => 'Dibuka di Uncen, fokus isu Pasifik',
            ],
            [
                'nama_program_studi' => 'Manajemen',
                'jenjang' => 'S1',
                'tahun' => 2025,
                'nilai' => 'Baik',
                'keterangan' => 'Jurusan paling populer secara nasional',
            ],
            [
                'nama_program_studi' => 'Akuntansi',
                'jenjang' => 'S1',
                'tahun' => 2025,
                'nilai' => 'Baik',
                'keterangan' => 'Dibutuhkan untuk sektor pemerintah & swasta',
            ],
            [
                'nama_program_studi' => 'Agribisnis',
                'jenjang' => 'S1',
                'tahun' => 2025,
                'nilai' => 'Baik',
                'keterangan' => 'Ada di Unipa dan Uncen (dengan nama mirip)',
            ],
            [
                'nama_program_studi' => 'Biologi',
                'jenjang' => 'S1',
                'tahun' => 2025,
                'nilai' => 'Baik',
                'keterangan' => 'Ada di Uncen, cocok untuk riset hutan & laut Papua',
            ],
            [
                'nama_program_studi' => 'Teknik Lingkungan',
                'jenjang' => 'S1',
                'tahun' => 2025,
                'nilai' => 'Baik',
                'keterangan' => 'Ada di Uncen, sangat relevan untuk Papua',
            ],
            [
                'nama_program_studi' => 'Ilmu Hukum',
                'jenjang' => 'S1',
                'tahun' => 2025,
                'nilai' => 'Baik',
                'keterangan' => 'Dibuka di Uncen dan beberapa PTS',
            ],
            [
                'nama_program_studi' => 'Sosiologi',
                'jenjang' => 'S1',
                'tahun' => 2025,
                'nilai' => 'Baik',
                'keterangan' => 'Ada di Uncen, penting untuk studi masyarakat adat',
            ],
            [
                'nama_program_studi' => 'Seni Rupa Daerah',
                'jenjang' => 'S1',
                'tahun' => 2025,
                'nilai' => 'Baik',
                'keterangan' => 'Adaptasi dari prodi seni budaya di Uncen',
            ],
            [
                'nama_program_studi' => 'Pengelolaan Pariwisata Adat',
                'jenjang' => 'S1',
                'tahun' => 2025,
                'nilai' => 'Baik',
                'keterangan' => 'Inovasi berdasarkan potensi wisata Papua',
            ],
        ];

        foreach ($data as $item) {
            Akreditasi::create($item); // ✅ otomatis generate UUID
        }
    }
}
