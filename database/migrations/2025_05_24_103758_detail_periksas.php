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
        Schema::create('detail_periksas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_periksa')->constrained('periksas')->onDelete('cascade'); // janji periksas - users
            $table->foreignId('id_obat')->constrained('obats')->onDelete('cascade'); // janji periksas - users
            // $table->timestamp('added_at');
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
