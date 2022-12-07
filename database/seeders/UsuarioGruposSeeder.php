<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsuarioGruposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('usuario_grupos')->insert([
            ['grupo' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
            ['grupo' => 'Cliente', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
