<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_paket_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_id')->constrained('paket_pendaftaran')->cascadeOnDelete();
            $table->foreignId('item_id')->constrained('item_perlengkapan')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_paket_item');
    }
};
