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
            $table->string('id_client')->nullable();
            $table->foreign('id_client')
                ->references('id')
                ->on('clients')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->string('id_student')->nullable();
            $table->foreign('id_student')
                ->references('id')
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
