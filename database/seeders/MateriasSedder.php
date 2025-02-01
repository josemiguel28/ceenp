<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MateriasSedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('materias')->insert([
            'nombre' => 'Introducción a la neuropedagogía',
            'descripcion' => 'Te ayudará a identificar los principios de la neuropedagogía dentro del proceso de enseñanza – aprendizaje y vincula sus conocimientos previos con los nuevos paradigmas educativos.',
            'semestre' => 1,
            'created_at' => now(),
        ]);
        DB::table('materias')->insert([
            'nombre' => 'Introducción a las neurociencias educativas',
            'descripcion' => 'Podrás categorizar la historia de la neurociencia, sus avances e importancia en el
            desarrollo social y descubrirás los aportes más importantes de los principales neurocientíficos a través de
            la historia.',
            'semestre' => 1,
            'created_at' => now(),
        ]);
        DB::table('materias')->insert([
            'nombre' => 'Modelos educativos centrados en el cerebro',
            'descripcion' => 'Lograrás identificar los actuales modelos pedagógicos como: la neurodidáctica y neuroeducación, para diseñar clases bajo la innovación académica de sus estudiantes.',
            'semestre' => 1,
            'created_at' => now(),
        ]);
        DB::table('materias')->insert([
            'nombre' => 'Currículo y planeación pedagógica centrado en el cerebro',
            'descripcion' => 'Distinguirá la importancia de la estructura y funcionamiento neuronal en el diseño de planes de estudio, construyendo objetivos y contenidos basados en el cerebro, vinculandolo conocimientos previos del diseño curricular hacia los procesos neurocognitivas, buscando resultados óptimos en el aprendizaje.',
            'semestre' => 1,
            'created_at' => now(),
        ]);
        DB::table('materias')->insert([
            'nombre' => 'Laboratorio pedagógico I',
            'descripcion' => 'Pone en práctica los conocimientos adquiridos durante el semestre, considerando la materia de “Laboratorio pedagógico I” como un espacio de adquisición
de resultados y de análisis para construir un plan de clase neuroeducativa considerando las tapas del desarrollo, las aportaciones y elementos sociales, familiares, emocionales, académicos, alimenticios y físicos del estudiante.',
            'semestre' => 1,
            'created_at' => now(),
        ]);

        // Segundo semestre
        DB::table('materias')->insert([
            'nombre' => 'Desarrollo cognitivo',
            'descripcion' => 'Identifica la importancia de las etapas de desarrollo en los sistemas cognitivos del ser humano, clasificando los elementos más importantes dentro de este proceso para los estudiantes y transfiere sus conocimientos previos sobre las teorías de desarrollo de aprendizaje de los estudiantes, conectando la información con la nueva información vinculada hacía los procesos cerebrales.',
            'semestre' => 2,
            'created_at' => now(),
        ]);
        DB::table('materias')->insert([
            'nombre' => 'El aprendizaje y las bases estructurales del cerebro',
            'descripcion' => 'Identificar cada una de las estructuras involucradas en el sistema nervioso, sus clasificaciones y áreas correspondientes y reconocer el papel que desempeña cada región del sistema nervioso (central, periférico y autónomo) dentro del proceso de aprendizaje de los estudiantes.',
            'semestre' => 2,
            'created_at' => now(),
        ]);
        DB::table('materias')->insert([
            'nombre' => 'Educación 4.0 y Gamificación',
            'descripcion' => 'Reconocer las características de cada modelo educativo que ha hecho uso de las plataformas tecnológicas como método de enseñanza – aprendizaje para identificar cada una de las aportaciones que han brindado.',
            'semestre' => 2,
            'created_at' => now(),
        ]);
        DB::table('materias')->insert([
            'nombre' => ' Elaboración de material didáctico y cognitivo',
            'descripcion' => 'Reconocer la aplicación de la neurodidáctica en el proceso de enseñanza – aprendizaje, las características y cómo diseñar clases considerando la neuroeducación y neuropedagogía e identificar los tipos de didáctica que existen, su influencia en el proceso educativo, evaluando el mejor proceso didáctico para aplicarlo a su contexto
áulico de los estudiantes.',
            'semestre' => 2,
            'created_at' => now(),
        ]);
        DB::table('materias')->insert([
            'nombre' => ' Laboratorio de pedagógico II',
            'descripcion' => 'Priorizan los elementos de la neuropedagogía para un adecuado proceso de evaluación, estableciendo parámetros humanistas y de funciones ejecutivas para
contextualizar el proceso y diseñar y contextualizar el material de apoyo, considerando a los estudiantes neurotípicos y neurodiversos según sus procesos y estilos de aprendizaje..',
            'semestre' => 2,
            'created_at' => now(),
        ]);

    }
}
