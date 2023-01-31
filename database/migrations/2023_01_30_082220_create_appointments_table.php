<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {

            $table->date('Date');

            $table->string('DNI_client');
            $table->foreign('DNI_client')->references('DNI')->on('clients');
            $table->string('DNI_Student');
            $table->foreign('DNI_Student')->references('DNI')->on('users');

            $table->integer('Treatment');
            $table->text('Protocol');
            $table->text('Advice');
            $table->text('Tracing');

            $table->primary(['Date' , 'DNI_client']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
