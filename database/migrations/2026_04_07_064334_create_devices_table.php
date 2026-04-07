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
        Schema::create('devices', function (Blueprint $table) {
          $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('status')->default('activo');
            $table->string('location');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->softDeletes(); // <--- ESTA ES LA COLUMNA QUE TE FALTA (deleted_at)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
