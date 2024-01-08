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

        /**
         * Database users seeders
         */
        DB::table('users')->insert([
            [

                'dni' => '30000001u',
                'rol' => 0,
                'course_year' => '23/24',
                'cycle' => 'ninguno',
                'name' => 'Administrador',
                'surname' => 'root',
                'email' => 'admin@ieseltablero.es',
                'email_verified_at' => now(),
                'Password' => Hash::make('root'),
                'others' => ' ',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'dni' => '31000000u',
                'rol' => 1,
                'course_year' => '23/24',
                'cycle' => 'ninguno',
                'name' => 'Manuela',
                'surname' => 'Escobar',
                'email' => 'manuela@ieseltablero.es',
                'email_verified_at' => now(),
                'Password' => Hash::make('root'),
                'others' => ' ',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),

            ], [
                'dni' => '31000002u',
                'rol' => 1,
                'course_year' => '23/24',
                'cycle' => 'ninguno',
                'name' => 'Jose Maria',
                'surname' => 'Alcantara',
                'email' => 'josemaria@ieseltablero.es',
                'email_verified_at' => now(),
                'Password' => Hash::make('root'),
                'others' => ' ',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),

            ], [
                'dni' => '31000001u',
                'rol' => 1,
                'course_year' => '23/24',
                'cycle' => 'ninguno',
                'name' => 'Josefina',
                'surname' => 'Guitierrez',
                'email' => 'josefin@ieseltablero.es',
                'email_verified_at' => now(),
                'Password' => Hash::make('root'),
                'others' => ' ',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),

            ], [

                'dni' => '31000003u',
                'rol' => 1,
                'course_year' => '23/24',
                'cycle' => 'ninguno',
                'name' => 'Sanfran',
                'surname' => 'Torreado',
                'email' => 'sanfran@ieseltablero.es',
                'email_verified_at' => now(),
                'Password' => Hash::make('root'),
                'others' => ' ',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),

            ], [
                'dni' => '31000004u',
                'rol' => 1,
                'course_year' => '23/24',
                'cycle' => 'ninguno',
                'name' => 'Pedro',
                'surname' => 'Sanchez',
                'email' => 'pedro@ieseltablero.es',
                'email_verified_at' => now(),
                'Password' => Hash::make('root'),
                'others' => ' ',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),

            ], [
                'dni' => '32000000u',
                'rol' => 2,
                'course_year' => '23/24',
                'cycle' => 'ninguno',
                'name' => 'Pedro',
                'surname' => 'Garcia',
                'email' => 'pedor@ieseltablero.es',
                'email_verified_at' => now(),
                'Password' => Hash::make('root'),
                'others' => ' ',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),

            ], [
                'dni' => '32000001u',
                'rol' => 2,
                'course_year' => '23/24',
                'cycle' => 'ninguno',
                'name' => 'Angel',
                'surname' => 'Mercoles',
                'email' => 'angel@ieseltablero.es',
                'email_verified_at' => now(),
                'Password' => Hash::make('root'),
                'others' => ' ',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),

            ], [
                'dni' => '32000002u',
                'rol' => 2,
                'course_year' => '23/24',
                'cycle' => 'ninguno',
                'name' => 'Alca',
                'surname' => 'Montes',
                'email' => 'alca@ieseltablero.es',
                'email_verified_at' => now(),
                'Password' => Hash::make('root'),
                'others' => ' ',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),

            ], [
                'dni' => '32000003u',
                'rol' => 2,
                'course_year' => '23/24',
                'cycle' => 'ninguno',
                'name' => 'Miguel',
                'surname' => 'Carmona',
                'email' => 'miqui@ieseltablero.es',
                'email_verified_at' => now(),
                'Password' => Hash::make('root'),
                'others' => ' ',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),

            ],
        ]);

        /**
         * Database clients seeders
         */
        DB::table('clients')->insert([
            [
                'dni' => '31000000c',
                'name' => 'Juan',
                'surname' => 'Aguilar',
                'birth_date' => '2002-08-21',
                'phone' => '681681681',
                'email' => 'juan@ieseltablero.es',
                'more_info' => ' ',
                'life_style' => ' ',
                'background_health' => ' ',
                'background_aesthetic' => ' ',
                'asthetic_routine' => ' ',
                'hairdressing_routine' => ' ',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'dni' => '32000000c',
                'name' => 'Fernando',
                'surname' => 'Caravaca',
                'birth_date' => '2000-05-24',
                'phone' => '680680680',
                'email' => 'fernando@ieseltablero.es',
                'more_info' => ' ',
                'life_style' => ' ',
                'background_health' => ' ',
                'background_aesthetic' => ' ',
                'asthetic_routine' => ' ',
                'hairdressing_routine' => ' ',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'dni' => '33000000c',
                'name' => 'Gonzalo',
                'surname' => 'Bretones',
                'birth_date' => '2001-10-01',
                'phone' => '682682682',
                'email' => 'bmq@ieseltablero.es',
                'more_info' => ' ',
                'life_style' => ' ',
                'background_health' => ' ',
                'background_aesthetic' => ' ',
                'asthetic_routine' => ' ',
                'hairdressing_routine' => ' ',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'dni' => '34000000c',
                'name' => 'Jose Luis',
                'surname' => 'Carretero',
                'birth_date' => '1995-04-12',
                'phone' => '683683683',
                'email' => 'joselu@ieseltablero.es',
                'more_info' => ' ',
                'life_style' => ' ',
                'background_health' => ' ',
                'background_aesthetic' => ' ',
                'asthetic_routine' => ' ',
                'hairdressing_routine' => ' ',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'dni' => '35000000c',
                'name' => 'Jose Ángel',
                'surname' => 'Marín',
                'birth_date' => '2001-05-26',
                'phone' => '685651651',
                'email' => 'joseangel@ieseltablero.es',
                'more_info' => ' ',
                'life_style' => ' ',
                'background_health' => ' ',
                'background_aesthetic' => ' ',
                'asthetic_routine' => ' ',
                'hairdressing_routine' => ' ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
