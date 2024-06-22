<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('unit_progresses', function (Blueprint $table) {
            $table->integer('unit_prog_id')->primary();
            $table->timestamp('created_at')->notNull();
            $table->timestamp('edited_at')->notNull();
            $table->string('up_desc')->notNull();
            $table->integer('student_pyp_id');
            $table->integer('report_id');
            $table->integer('unit_id');
            
            // $table->foreign('student_pyp_id')->references('nim_pyp')->on('students_pyp')->onDelete('cascade');
            // $table->foreign('report_id')->references('report_id')->on('reports')->onDelete('cascade');
            // $table->foreign('unit_id')->references('unit_id')->on('units')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('unit_progresses');
    }
};
