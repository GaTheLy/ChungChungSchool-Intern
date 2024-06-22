<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('key_concepts', function (Blueprint $table) {
            $table->integer('key_concepts_id')->primary();
            $table->timestamp('created_at')->notNull();
            $table->timestamp('edited_at')->notNull();
            $table->string('topic')->notNull();
            $table->string('question')->notNull();
            $table->string('definition')->notNull();
            $table->binary('kc_icon')->notNull(); // Assuming the image is stored as binary data
            $table->integer('unit_id');
            
            // $table->foreign('unit_id')->references('unit_id')->on('units')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('key_concepts');
    }
};
