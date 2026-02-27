<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('investigations', function (Blueprint $table) {
    $table->id();

    $table->foreignId('report_id')->constrained('reports')->onDelete('cascade');
    $table->foreignId('assigned_to')->constrained('users');

    $table->text('remarks')->nullable();
    $table->enum('status',['ongoing','resolved','closed']);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investigations');
    }
};
