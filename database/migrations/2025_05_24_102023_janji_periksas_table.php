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
        //
        Schema::create('janji_periksas', function (Blueprint $table) {
            $table->id();
            // $table->enum('hari', ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu']);
            $table->string('keluhan');
            $table->integer('no_antrian');
        
            $table->foreignId('id_pasien')->constrained('users')->onDelete('cascade'); // janji periksas - users
            $table->foreignId('id_jadwal_periksa')->constrained('jadwal_periksas')->onDelete('cascade'); // janji periksas - jadwal periksas
            // $table->rememberToken();
            // $table->timestamps();
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
