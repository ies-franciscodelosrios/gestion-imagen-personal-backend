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
            $table->id();
            $table->date('date')->nullable();
            $table->string('dni_client')->nullable();
            $table->foreign('dni_client')
                ->references('dni')
                ->on('clients')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->string('dni_student')->nullable();
            $table->foreign('dni_student')
                ->references('dni')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->integer('treatment')->nullable();
            $table->text('protocol')->nullable();
            $table->text('consultancy')->nullable();
            $table->text('tracking')->nullable();
            $table->text('survey')->nullable();
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
        Schema::dropIfExists('appointments');
    }
}
