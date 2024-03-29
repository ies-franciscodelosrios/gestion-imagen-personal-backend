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

         DB::table('vocational_education')->insert([
            [
                'short_name' => 'FPB PE',
                'long_name' => 'FPB Peluquería y estética',
                'description' => 'Formación Profesional Básica de Peluquería y estética',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'short_name' => 'GM PCC',
                'long_name' => 'GM Peluquería y cosmética capilar',
                'description' => 'Grado Medio de Peluquería y cosmética capilar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'short_name' => 'GM EB',
                'long_name' => 'GM Estética y belleza',
                'description' => 'Grado Medio de Estética y belleza',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'short_name' => 'GS EIB',
                'long_name' => 'GS Estética integral y bienestar',
                'description' => 'Grado Superior de Estética integral y bienestar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'short_name' => 'GS EDP',
                'long_name' => 'GS estilismo y dirección de peluquería',
                'description' => 'Grado Superior de estilismo y dirección de peluquería',
                'created_at' => now(),
                'updated_at' => now(),
            ],

         ]);

        DB::table('users')->insert([
            [

                'dni' => '05986869S',
                'rol' => 0,
                'course_year' => '23-24',
                'cycle' => 1,
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
                'dni' => '82536333M',
                'rol' => 1,
                'course_year' => '23-24',
                'cycle' => 2,
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
                'dni' => '77378266X',
                'rol' => 1,
                'course_year' => '23-24',
                'cycle' => 1,
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
                'dni' => '53002792M',
                'rol' => 1,
                'course_year' => '23-24',
                'cycle' => 2,
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

                'dni' => '47863517B',
                'rol' => 1,
                'course_year' => '23-24',
                'cycle' => 2,
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
                'dni' => '35138942W',
                'rol' => 1,
                'course_year' => '23-24',
                'cycle' => 3,
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
                'dni' => '42634833D',
                'rol' => 2,
                'course_year' => '23-24',
                'cycle' => 4,
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
                'dni' => '30507984W',
                'rol' => 2,
                'course_year' => '23-24',
                'cycle' => 1,
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
                'dni' => '27774202T',
                'rol' => 2,
                'course_year' => '23-24',
                'cycle' => 3,
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
                'dni' => '64089491Z',
                'rol' => 2,
                'course_year' => '23-24',
                'cycle' => 2,
                'name' => 'Miguel',
                'surname' => 'Carmona',
                'email' => 'miqui@ieseltablero.es',
                'email_verified_at' => now(),
                'Password' => Hash::make('root'),
                'others' => ' ',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),

            ],[
                'dni' => '14976375V',
                'rol' => 2,
                'course_year' => '23-24',
                'cycle' => 1,
                'name' => 'Francisco Javier',
                'surname' => 'Ordoñez',
                'email' => 'fjsalamanca@ieseltablero.es',
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
