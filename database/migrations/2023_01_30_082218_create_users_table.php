<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('DNI')->primary();
            $table->integer('Rol');
            $table->date('Course_year');
            $table->string('Cycle');
            $table->string('Name');
            $table->string('Surname');
            $table->string('Email');
            $table->string('Password');
            $table->string('Others');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
