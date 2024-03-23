<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;
class SubjectTabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $asignatura1 = new Subject();
        $asignatura1->name = "Desarrollo Web Entorno Servidor";
        $asignatura1->save();

        $asignatura2 = new Subject();
        $asignatura2->name = "Diseño de Interfaces Web";
        $asignatura2->save();

        $asignatura3 = new Subject();
        $asignatura3->name = "Despliegue de Aplicaciones Web";
        $asignatura3->save();

        $asignatura4 = new Subject();
        $asignatura4->name = "Desarrollo WEB en Entorno Cliente";
        $asignatura4->save();

        $asignatura5 = new Subject();
        $asignatura5->name = "Inglés";
        $asignatura5->save();

        $asignatura6 = new Subject();
        $asignatura6->name = "Empresa e Iniciativa Emprendedora";
        $asignatura6->save();
    }
}
