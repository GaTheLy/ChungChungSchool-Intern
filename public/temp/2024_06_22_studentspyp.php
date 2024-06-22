<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students_pyp', function (Blueprint $table) {
            $table->integer('nim_pyp')->primary();
            $table->string('first_name')->notNull();
            $table->string('last_name')->notNull();
            $table->string('middle_name')->nullable();
            $table->string('nick_name')->nullable();
            $table->timestamp('created_at')->notNull();
            $table->date('birth_date')->notNull();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students_pyp');
    }
};
