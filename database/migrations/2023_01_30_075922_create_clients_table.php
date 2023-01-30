<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->string('DNI');
            $table->string('Name');
            $table->string('Surname');
            $table->integer('Birth_Date');
            $table->integer('Phone');
            $table->string('Email');
            $table->string('More_Info');
            $table->string('Life_Style');
            $table->string('Health_History');
            $table->string('Aesthetic_Background');
            $table->string('Asthetic_Routine');
            $table->string('Hairdressing_Routine');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
