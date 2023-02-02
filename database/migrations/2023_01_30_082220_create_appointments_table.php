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

            $table->bigIncrements('id');
            $table->date('Date')->nullable();

            $table->string('DNI_client')->nullable();

            $table->foreign('DNI_client')->references('DNI')->on('clients')
                ->onUpdate('cascade')
                ->onDelete('set null')
                ;

            $table->string('DNI_Student')->nullable();

            $table->foreign('DNI_Student')->references('DNI')->on('users')
                ->onUpdate('cascade')
                ->onDelete('set null')
            ;


            $table->integer('Treatment')->nullable();
            $table->text('Protocol')->nullable();
            $table->text('Consultancy')->nullable();
            $table->text('Tracking')->nullable();
            $table->text('Survey')->nullable();
            $table->timestamps();

           /*  $table->primary(['Date', 'DNI_client']); */

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
