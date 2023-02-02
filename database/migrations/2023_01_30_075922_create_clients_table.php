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

            $table->bigIncrements('id');
            $table->string('DNI')->unique();
            $table->string('Name');
            $table->string('Surname');
            $table->date('Birth_Date');
            $table->integer('Phone');
            $table->string('Email');
            $table->string('More_Info');
            $table->string('Life_Style');
            $table->string('Background_Health');
            $table->string('Background_Aesthetic');
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
