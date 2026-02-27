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
        Schema::create('reports', function (Blueprint $table) {
    $table->id();

    $table->foreignId('reported_by')->constrained('users');

    $table->enum('status',['pending','approved','rejected'])->default('pending');

    $table->string('filename')->nullable();
    $table->string('mime_type')->nullable();
    $table->string('file_path')->nullable();

    $table->decimal('latitude',10,7)->nullable();
    $table->decimal('longitude',10,7)->nullable();
    $table->string('address')->nullable();
    $table->string('city_region')->nullable();

    $table->timestamp('captured_at')->nullable();
    $table->string('gmt_offset')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
