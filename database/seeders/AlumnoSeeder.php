<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Alumno;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alumnos = [
            ['nombre' => 'ANTONIO', 'apellidos' => 'García López'],
            ['nombre' => 'CARMEN', 'apellidos' => 'Fernández Ruiz'],
            ['nombre' => 'CRISTINA', 'apellidos' => 'Martín Pérez'],
            ['nombre' => 'ÁNGEL', 'apellidos' => 'Sánchez Torres'],
            ['nombre' => 'DYLAN', 'apellidos' => 'Romero Díaz'],
            ['nombre' => 'PEDRO', 'apellidos' => 'Moreno Castro'],
            ['nombre' => 'PEDRO', 'apellidos' => 'Navarro Molina'],
            ['nombre' => 'JAVI', 'apellidos' => 'Jiménez Ortiz'],
            ['nombre' => 'JAVIER', 'apellidos' => 'Ramos Vega'],
            ['nombre' => 'JUAN DAVID', 'apellidos' => 'Herrera León'],
            ['nombre' => 'Sergio', 'apellidos' => 'Muñoz Gil'],
        ];

        foreach ($alumnos as $alumno) {
            Alumno::create($alumno);
        }
    }
}
