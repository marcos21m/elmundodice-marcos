<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Con modelo
        $user = User::create([
            'name_apellido' => 'Pedro Gonzalez',
            'email' => 'marcos21_m@hotmail.com',
            'password' => Hash::make('Marcos_1989'),
            'roles' => 'admin',
        ]);

        $user2 = User::create([
            'name_apellido' => 'Tania Benitez',
            'email' => 'tania20_b@hotmail.com',
            'password' => Hash::make('Marcos_1989'),
            'roles' => 'chef',
        ]);

        $user3 = User::create([
            'name_apellido' => 'Prueba',
            'email' => 'prueba@hotmail.com',
            'password' => Hash::make('Marcos_1989'),
        ]);
    }
}
