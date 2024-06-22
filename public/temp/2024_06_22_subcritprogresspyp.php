<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subject_crit_progresses', function (Blueprint $table) {
            $table->integer('scp_id')->primary();
            $table->timestamp('created_at')->notNull();
            $table->timestamp('edited_at')->notNull();
            $table->string('scp_desc')->notNull();
            $table->integer('student_pyp_id');
            $table->integer('report_id');
            $table->integer('sc_id');
            
            // $table->foreign('student_pyp_id')->references('nim_pyp')->on('students_pyp')->onDelete('cascade');
            // $table->foreign('report_id')->references('report_id')->on('reports')->onDelete('cascade');
            // $table->foreign('sc_id')->references('sc_pyp_id')->on('sub_criteria_pyp')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subject_crit_progresses');
    }
};
