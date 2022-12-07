<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            ['nombre' => 'Super', 'apellido' => 'Admin', 'password' => bcrypt('123456789'), 'telefono' => '04128008473', 'email' => 'admin@barberfreed.com', 'usuario_grupo_id' => 1, 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Gabriel', 'apellido' => 'Ravelo', 'password' => bcrypt('123456789'), 'telefono' => '04160546539', 'email' => 'gravelo@gmail.com', 'usuario_grupo_id' => 2, 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
