<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PuestosSeeder extends Seeder
{
    public function run()
    {
        DB::table('puestos')->insert([
            ['nombre' => 'Desarrollador Backend'],
            ['nombre' => 'Desarrollador Frontend'],
            ['nombre' => 'Desarrollador Full Stack'],
            ['nombre' => 'Administrador de Sistemas'],
            ['nombre' => 'Técnico de Soporte'],
            ['nombre' => 'Diseñador Gráfico'],
            ['nombre' => 'Diseñador UX/UI'],
            ['nombre' => 'Project Manager'],
            ['nombre' => 'Analista de Datos'],
            ['nombre' => 'Especialista en Marketing Digital'],
            ['nombre' => 'Community Manager'],
            ['nombre' => 'Comercial'],
            ['nombre' => 'Atención al Cliente'],
            ['nombre' => 'Contable'],
            ['nombre' => 'Auxiliar Administrativo'],
            ['nombre' => 'Responsable de RRHH'],
            ['nombre' => 'Enfermero/a'],
            ['nombre' => 'Profesor/a'],
            ['nombre' => 'Camarero/a'],
            ['nombre' => 'Cocinero/a'],
            ['nombre' => 'Operario/a de Producción'],
            ['nombre' => 'Abogado/a'],
        ]);
    }
}
