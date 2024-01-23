<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    
    public function test_get_user_list(): void
    {
        //En el metodo le podemos también pasar los headers
        //Primer test con el login
        $login = $this->post('/api/login', [

            "email"=>"admin@ieseltablero.es",
            "password"=> "root",
            "device"=> "dev_client"
              
        ], [
            'Accept' => 'application/json'
        ]);
        $login -> assertStatus(200);
        echo "\n post('/api/login' OK";
        $users = $this->get('/api/users');
        //Con assert podemos comprobar estado, si se ha descargado, si acceso prohibido...
        //Con assertStatus podemos comprobar el estado de la respuesta
       
        $users -> assertStatus(200);
        echo "\n get('/api/users'); OK";
        //Comprobamos que el array tiene las propiedades que nos interesa
        //dump muestra el array en la consola
        dump($users->json());
        //Error en la estructura https://chat.openai.com/c/4ea2b5ba-7c2c-4e8c-970b-fae6f982d74c
        /*$users -> assertJsonStructure([
            'data'=> [
                '*' => [
                ['id','name','email','email_verified_at','created_at','updated_at','dni','rol','course_year','cycle','surname','others']
                ]
            ]
        ]);*/
        //valido que existe un elemento en el array con el nombre Juanjo
        $users -> assertJsonFragment([
            'name' => 'Administrador'
        ]);
        //valido que existen x elementos
        //$response -> assertJsonCount(10);
        
        
    }
}
