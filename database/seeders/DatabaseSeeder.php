<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [

                'DNI' => '0000a',
                'Rol' => 0,
                'Course_year' => now(),
                'Cycle' => 'ninguno',
                'Name' => 'Administrador',
                'Surname' => 'root',
                'Email' => 'admin@iestablero',
                'email_verified_at' => now(),
                'Password' => Hash::make('root'),
                'Others' => 'nada',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'DNI' => '0001a',
                'Rol' => 1,
                'Course_year' => now(),
                'Cycle' => 'ninguno',
                'Name' => 'Juan',
                'Surname' => 'Aguilar',
                'Email' => 'juan@iestablero',
                'email_verified_at' => now(),
                'Password' => Hash::make('root'),
                'Others' => 'nada',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),

            ], [
                'DNI' => '0002a',
                'Rol' => 2,
                'Course_year' => now(),
                'Cycle' => 'ninguno',
                'Name' => 'Gonzalo',
                'Surname' => 'Bretones',
                'Email' => 'bmq@iestablero',
                'email_verified_at' => now(),
                'Password' => Hash::make('root'),
                'Others' => 'nada',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),

            ]
        ]);
    }
}
