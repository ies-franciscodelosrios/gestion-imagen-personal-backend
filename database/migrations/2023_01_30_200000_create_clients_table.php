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
            $table->string('dni')->unique()->nullable();
            $table->string('name');
            $table->string('surname');
            $table->date('birth_date');
            $table->integer('phone')->nullable();
            $table->string('email')->unique()->nullable();
            $table->text('more_info')->nullable();
            $table->text('life_style')->nullable();
            $table->text('background_health')->nullable();
            $table->text('background_aesthetic')->nullable();
            $table->text('asthetic_routine')->nullable();
            $table->text('hairdressing_routine')->nullable();
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
