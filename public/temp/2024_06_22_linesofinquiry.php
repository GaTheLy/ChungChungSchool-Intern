<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lines_of_inquiry', function (Blueprint $table) {
            $table->integer('lines_of_inquiry_id')->primary();
            $table->timestamp('created_at')->notNull();
            $table->timestamp('edited_at')->notNull();
            $table->string('loi_description')->notNull();
            $table->binary('loi_icon')->notNull(); // Assuming the image is stored as binary data
            $table->integer('unit_id');
            
            // $table->foreign('unit_id')->references('unit_id')->on('units')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lines_of_inquiry');
    }
};
