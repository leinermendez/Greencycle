<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trees', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('seed_type_id')
                ->constrained('seed_types');

            $table->unsignedTinyInteger('level')->default(0);
            $table->unsignedInteger('care_count')->default(0);
            $table->unsignedTinyInteger('health')->default(100);

            // ACTIVE, MATURE, HARVESTED, DEAD
            $table->string('status', 20)->default('ACTIVE')->index();

            // Reglas temporales (el servidor es la única fuente de verdad)
            $table->timestamp('last_cared_at')->nullable();
            $table->timestamp('next_care_at')->nullable();
            $table->timestamp('last_decay_at')->nullable();

            $table->timestamp('planted_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trees');
    }
};
