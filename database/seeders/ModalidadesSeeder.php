<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModalidadesSeeder extends Seeder
{
    public function run()
    {
        DB::table('modalidad')->insert([
            ['nombre' => 'Presencial'],
            ['nombre' => 'A distancia'],
            ['nombre' => 'Híbrida'],
        ]);
    }
}
