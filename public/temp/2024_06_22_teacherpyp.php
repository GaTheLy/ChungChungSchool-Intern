<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teachers_pyp', function (Blueprint $table) {
            $table->integer('nip_pyp')->primary();
            $table->string('first_name')->notNull();
            $table->string('last_name')->notNull();
            $table->string('middle_name')->nullable();
            $table->string('emails')->notNull();
            $table->string('address')->notNull();
            $table->string('phone')->notNull(); // Changed to string
            $table->timestamp('created_at')->notNull();
            $table->date('birth_date')->notNull();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teachers_pyp');
    }
};
