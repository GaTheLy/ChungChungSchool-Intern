<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sub_criteria_pyp', function (Blueprint $table) {
            $table->integer('sc_pyp_id')->primary();
            $table->timestamp('created_at')->notNull();
            $table->timestamp('edited_at')->notNull();
            $table->string('sc_name')->notNull();
            $table->string('sc_desc')->notNull();
            $table->integer('subject_pyp_id');
            $table->integer('report_id');
            
            // $table->foreign('subject_pyp_id')->references('subject_pyp_id')->on('subjects_pyp')->onDelete('cascade');
            // $table->foreign('report_id')->references('report_id')->on('reports')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_criteria_pyp');
    }
};
