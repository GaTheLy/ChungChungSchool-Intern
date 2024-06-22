<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('atl_progresses', function (Blueprint $table) {
            $table->integer('atl_prog_id')->primary();
            $table->timestamp('created_at')->notNull();
            $table->timestamp('edited_at')->notNull();
            $table->string('atl_prog_desc')->notNull();
            $table->integer('student_pyp_id');
            $table->integer('report_id');
            $table->integer('atl_id');
            
            // $table->foreign('student_pyp_id')->references('nim_pyp')->on('students_pyp')->onDelete('cascade');
            // $table->foreign('report_id')->references('report_id')->on('reports')->onDelete('cascade');
            // $table->foreign('atl_id')->references('atl_id')->on('approaches_to_learning')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('atl_progresses');
    }
};
