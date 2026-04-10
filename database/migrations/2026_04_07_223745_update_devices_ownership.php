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
      Schema::table('devices', function (Blueprint $table) {
        // Quitamos nullable() para obligar a que cada equipo tenga un dueño
        $table->foreignId('client_id')->after('id')->constrained('clients')->onDelete('cascade');
        
        // Eliminamos la relación vieja con user_id si ya no se usará
        if (Schema::hasColumn('devices', 'user_id')) {
            $table->dropForeign(['user_id']); 
            $table->dropColumn('user_id');
        }
    
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
