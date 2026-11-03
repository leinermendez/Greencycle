
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('species_catalog', function (Blueprint $table) {
            $table->id();

            $table->foreignId('seed_type_id')
                ->constrained('seed_types');

            $table->string('name', 100);
            $table->string('image_url', 255);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('species_catalog');
    }
};
