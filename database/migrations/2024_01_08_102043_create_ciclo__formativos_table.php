<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ciclo__formativos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('short_name');
            $table->string('long_name');
            $table->string('descripcion');
            $table->string('created_at');
            $table->string('updated_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ciclo__formativos');
    }
};
