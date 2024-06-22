<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('approaches_to_learning', function (Blueprint $table) {
            $table->integer('atl_id')->primary();
            $table->timestamp('created_at')->notNull();
            $table->timestamp('edited_at')->notNull();
            $table->string('atl_description')->notNull();
            $table->binary('atl_icon')->notNull(); // Assuming the image is stored as binary data
            $table->integer('unit_id');
            
            $table->foreign('unit_id')->references('unit_id')->on('units')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('approaches_to_learning');
    }
};
