<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->integer('report_id')->primary();
            $table->timestamp('created_at')->notNull();
            $table->timestamp('edited_at')->notNull();
            $table->string('period_desc')->notNull();
            $table->date('period_start')->notNull();
            $table->date('period_end')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
