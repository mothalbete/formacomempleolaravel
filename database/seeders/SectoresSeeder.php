<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectoresSeeder extends Seeder
{
    public function run()
    {
        DB::table('sectores')->insert([
            ['nombre' => 'Tecnología'],
            ['nombre' => 'Marketing y Publicidad'],
            ['nombre' => 'Ventas y Comercial'],
            ['nombre' => 'Administración y Finanzas'],
            ['nombre' => 'Recursos Humanos'],
            ['nombre' => 'Logística y Transporte'],
            ['nombre' => 'Sanidad'],
            ['nombre' => 'Educación'],
            ['nombre' => 'Hostelería y Turismo'],
            ['nombre' => 'Construcción'],
            ['nombre' => 'Industria y Producción'],
            ['nombre' => 'Legal'],
            ['nombre' => 'Diseño y Creatividad'],
        ]);
    }
}
