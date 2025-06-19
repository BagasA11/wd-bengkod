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
        Schema::create('periksas', function (Blueprint $table) {
            $table->id();
            $table->string('catatan');
            $table->dateTime('tgl_periksa');
            $table->integer('biaya'); // 150.000 + obat

            $table->foreignId('id_janji_periksa')->constrained('janji_periksas')->onDelete('cascade'); // janji periksas - users
            $table->timestamp('added_at');
            // $table->timestamp('added_at')->default(DB::raw('CURRENT_TIMESTAMP'));

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
