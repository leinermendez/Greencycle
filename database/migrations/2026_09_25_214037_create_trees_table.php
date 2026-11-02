<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   Schema::create('trees', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')
        ->constrained('users')
        ->onDelete('cascade');

    $table->foreignId('species_id')
        ->nullable()
        ->constrained('species_catalog')
        ->nullOnDelete();

    $table->string('seed_type', 20)->default('NORMAL');
    $table->integer('level')->default(0);
    $table->integer('care_count')->default(0);
    $table->integer('health')->default(100);
    $table->string('status', 30)->default('PLANTED');

    $table->timestamp('auto_water_until')->nullable();
    $table->timestamp('accelerator_until')->nullable();

    $table->timestamp('planted_at')->useCurrent();
    $table->timestamp('updated_at')->nullable();
});

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trees');
    }
};
