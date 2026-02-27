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
        Schema::create('file_storage', function (Blueprint $table) {
    $table->id();

    $table->foreignId('resident_id')->nullable()->constrained('residents');
    $table->foreignId('uploaded_by')->constrained('users');

    $table->string('category')->nullable();
    $table->string('file_name');
    $table->string('file_path');
    $table->enum('visibility',['public','private'])->default('private');
    $table->string('status')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_storage');
    }
};
