<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('units', function (Blueprint $table) {
            $table->integer('unit_id')->primary();
            $table->timestamp('created_at')->notNull();
            $table->timestamp('edited_at')->notNull();
            $table->string('central_idea')->notNull();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
