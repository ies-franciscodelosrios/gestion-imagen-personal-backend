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
            $table->string('Email')->unique();
            $table->text('More_Info')->nullable();
            $table->text('Life_Style');
            $table->text('Background_Health');
            $table->text('Background_Aesthetic');
            $table->text('Asthetic_Routine');
            $table->text('Hairdressing_Routine');
            $table->timestamps();
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
