<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstatusSeeder extends Seeder
{
    public function run(): void
    {
        $estatus = ['Abierto', 'En proceso', 'Concluido'];

        foreach ($estatus as $e) {
            DB::table('estatus')->updateOrInsert(
                ['nombre' => $e],
                ['nombre' => $e]
            );
        }
    }
}

