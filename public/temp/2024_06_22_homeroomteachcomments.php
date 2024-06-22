<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('homeroom_teacher_comments', function (Blueprint $table) {
            $table->integer('htc_id')->primary();
            $table->timestamp('created_at')->notNull();
            $table->timestamp('edited_at')->notNull();
            $table->string('htc_desc')->notNull();
            $table->integer('student_pyp_id');
            $table->integer('report_id');
            $table->integer('homeroom_id');
            
            // $table->foreign('student_pyp_id')->references('nim_pyp')->on('students_pyp')->onDelete('cascade');
            // $table->foreign('report_id')->references('report_id')->on('reports')->onDelete('cascade');
            // $table->foreign('homeroom_id')->references('homeroom_id')->on('homeroom_pyp')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('homeroom_teacher_comments');
    }
};
