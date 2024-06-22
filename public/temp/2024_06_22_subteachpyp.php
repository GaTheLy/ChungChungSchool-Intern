<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sub_teachers_pyp', function (Blueprint $table) {
            $table->integer('sub_teacher_pyp_id')->primary();
            $table->timestamp('created_at')->notNull();
            $table->timestamp('edited_at')->notNull();
            $table->integer('subject_pyp_id');
            $table->integer('teacher_id');
            
            // $table->foreign('subject_pyp_id')->references('subject_pyp_id')->on('subjects_pyp')->onDelete('cascade');
            // $table->foreign('teacher_id')->references('nip_pyp')->on('teachers_pyp')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_teachers_pyp');
    }
};
