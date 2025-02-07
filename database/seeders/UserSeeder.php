<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'administrador@ceenp.com',
            'password' => bcrypt('secret'),
            'role_id' => 1,
            'matricula' => '1',
            'created_at' => now(),
        ]);
    }
}
