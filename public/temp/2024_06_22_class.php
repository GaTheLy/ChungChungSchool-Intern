<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('class', function (Blueprint $table) {
            $table->integer('class_id')->primary();
            $table->string('class_name')->notNull();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class');
    }
};
