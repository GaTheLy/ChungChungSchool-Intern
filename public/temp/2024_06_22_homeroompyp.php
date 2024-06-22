<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('homeroom_pyp', function (Blueprint $table) {
            $table->integer('homeroom_id')->primary();
            $table->integer('teacher_pyp_id');
            $table->integer('class_id');
            
            // $table->foreign('teacher_pyp_id')->references('nip_pyp')->on('teachers_pyp')->onDelete('cascade');
            // $table->foreign('class_id')->references('class_id')->on('class')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('homeroom_pyp');
    }
};
