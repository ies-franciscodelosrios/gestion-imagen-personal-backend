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

                'DNI' => '30000001u',
                'Rol' => 0,
                'Course_year' => now(),
                'Cycle' => 'ninguno',
                'Name' => 'Administrador',
                'Surname' => 'root',
                'Email' => 'admin@iestablero',
                'email_verified_at' => now(),
                'Password' => Hash::make('root'),
                'Others' => ' ',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],[
                'DNI' => '31000000u',
                'Rol' => 1,
                'Course_year' => now(),
                'Cycle' => 'ninguno',
                'Name' => 'Manuela',
                'Surname' => 'Escobar',
                'Email' => 'manuela@iestablero',
                'email_verified_at' => now(),
                'Password' => Hash::make('root'),
                'Others' => ' ',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),

            ],[
                'DNI' => '31000002u',
                'Rol' => 1,
                'Course_year' => now(),
                'Cycle' => 'ninguno',
                'Name' => 'Jose Maria',
                'Surname' => 'Alcantara',
                'Email' => 'josemaria@iestablero',
                'email_verified_at' => now(),
                'Password' => Hash::make('root'),
                'Others' => '',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),

            ],[
                'DNI' => '31000001u',
                'Rol' => 1,
                'Course_year' => now(),
                'Cycle' => 'ninguno',
                'Name' => 'Josefina',
                'Surname' => 'Guitierrez',
                'Email' => 'josefin@iestablero',
                'email_verified_at' => now(),
                'Password' => Hash::make('root'),
                'Others' => ' ',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),

            ],[

                'DNI' => '31000003u',
                'Rol' => 1,
                'Course_year' => now(),
                'Cycle' => 'ninguno',
                'Name' => 'Sanfran',
                'Surname' => 'Torreado',
                'Email' => 'sanfran@iestablero',
                'email_verified_at' => now(),
                'Password' => Hash::make('root'),
                'Others' => ' ',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),

            ],[
                'DNI' => '31000004u',
                'Rol' => 1,
                'Course_year' => now(),
                'Cycle' => 'ninguno',
                'Name' => 'Pedro',
                'Surname' => 'Sanchez',
                'Email' => 'pedro@iestablero',
                'email_verified_at' => now(),
                'Password' => Hash::make('root'),
                'Others' => ' ',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),

            ],[
                'DNI' => '32000000u',
                'Rol' => 2,
                'Course_year' => now(),
                'Cycle' => 'ninguno',
                'Name' => 'Pedro',
                'Surname' => 'Garcia',
                'Email' => 'pedor@iestablero',
                'email_verified_at' => now(),
                'Password' => Hash::make('root'),
                'Others' => ' ',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),

            ],[
                'DNI' => '32000001u',
                'Rol' => 2,
                'Course_year' => now(),
                'Cycle' => 'ninguno',
                'Name' => 'Angel',
                'Surname' => 'Mercoles',
                'Email' => 'angel@iestablero',
                'email_verified_at' => now(),
                'Password' => Hash::make('root'),
                'Others' => ' ',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),

            ]
        ]);

        /**
         * Database clients seeders
         */
        DB::table('clients')->insert([
            [
                'DNI' => '31000000c',
                'Name' => 'Juan',
                'Surname' => 'Aguilar',
                'Birth_Date' => '2002-08-21',
                'Phone' => '681681681',
                'Email' => 'juan@iestablero',
                'More_Info' => ' ',
                'Life_Style' => ' ',
                'Background_Health' => ' ',
                'Background_Aesthetic' => ' ',
                'Asthetic_Routine' => ' ',
                'Hairdressing_Routine' => ' ',
                'created_at' => now(),
                'updated_at' => now(),
            ],[
                'DNI' => '32000000c',
                'Name' => 'Fernando',
                'Surname' => 'Caravaca',
                'Birth_Date' => '2000-05-24',
                'Phone' => '680680680',
                'Email' => 'fernando@iestablero',
                'More_Info' => ' ',
                'Life_Style' => ' ',
                'Background_Health' => ' ',
                'Background_Aesthetic' => ' ',
                'Asthetic_Routine' => ' ',
                'Hairdressing_Routine' => ' ',
                'created_at' => now(),
                'updated_at' => now(),
            ],[
                'DNI' => '33000000c',
                'Name' => 'Gonzalo',
                'Surname' => 'Bretones',
                'Birth_Date' => '2001-10-01',
                'Phone' => '682682682',
                'Email' => 'bmq@iestablero',
                'More_Info' => ' ',
                'Life_Style' => ' ',
                'Background_Health' => ' ',
                'Background_Aesthetic' => ' ',
                'Asthetic_Routine' => ' ',
                'Hairdressing_Routine' => ' ',
                'created_at' => now(),
                'updated_at' => now(),
            ],[
                'DNI' => '34000000c',
                'Name' => 'Jose Luis',
                'Surname' => 'Carretero',
                'Birth_Date' => '1995-04-12',
                'Phone' => '683683683',
                'Email' => 'joselu@iestablero',
                'More_Info' => ' ',
                'Life_Style' => ' ',
                'Background_Health' => ' ',
                'Background_Aesthetic' => ' ',
                'Asthetic_Routine' => ' ',
                'Hairdressing_Routine' => ' ',
                'created_at' => now(),
                'updated_at' => now(),
            ],[
                'DNI' => '35000000c',
                'Name' => 'Jose Ángel',
                'Surname' => 'Marín',
                'Birth_Date' => '2001-05-26',
                'Phone' => '685651651',
                'Email' => 'joseangel@iestablero',
                'More_Info' => ' ',
                'Life_Style' => ' ',
                'Background_Health' => ' ',
                'Background_Aesthetic' => ' ',
                'Asthetic_Routine' => ' ',
                'Hairdressing_Routine' => ' ',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);


    }
}
