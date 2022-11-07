<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('servicios')->insert([
            ['nombre' => 'Corte de cabello de hombre', 'precio' => 3, 'created_at' => now(), 'updated_at' => now() ],
            ['nombre' => 'Corte de cabello de niño', 'precio' => 4, 'created_at' => now(), 'updated_at' => now() ],
            ['nombre' => 'Corte de cabello de mujer', 'precio' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Peinado de hombre', 'precio' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Peinado de mujer', 'precio' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Corte de barba', 'precio' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Tinte de cabello para hombre', 'precio' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Tinte de cabello para mujer', 'precio' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Lavado de cabello', 'precio' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Tratamiento capilar', 'precio' => 20, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
