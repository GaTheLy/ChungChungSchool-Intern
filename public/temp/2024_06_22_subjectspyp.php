<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subjects_pyp', function (Blueprint $table) {
            $table->integer('subject_pyp_id')->primary();
            $table->timestamp('created_at')->notNull();
            $table->timestamp('edited_at')->notNull();
            $table->string('sub_name')->notNull();
            $table->string('sub_desc')->notNull();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subjects_pyp');
    }
};
