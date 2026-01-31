<?php

namespace Database\Seeders;

use App\Models\SiteStat;
use Illuminate\Database\Seeder;

class SiteStatSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'label'       => 'Mahasiswa',
                'value'       => 10000,
                'suffix'      => '+',
                'description' => 'Mengikuti program studi dari berbagai jurusan unggulan.',
                'sort'        => 1,
                'is_active'   => true,
            ],
            [
                'label'       => 'Fakultas',
                'value'       => 20,
                'suffix'      => '+',
                'description' => 'Dikelola oleh tenaga pengajar profesional dan berpengalaman.',
                'sort'        => 2,
                'is_active'   => true,
            ],
            [
                'label'       => 'Tahun Pengalaman',
                'value'       => 30,
                'suffix'      => ' Tahun',
                'description' => 'Menghasilkan lulusan yang siap bersaing di dunia kerja.',
                'sort'        => 3,
                'is_active'   => true,
            ],
        ];

        foreach ($rows as $r) {
            SiteStat::updateOrCreate(['label' => $r['label']], $r);
        }
    }
}
