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
        Schema::create('residents', function (Blueprint $table) {
    $table->id();

    $table->string('first_name');
    $table->string('middle_name')->nullable();
    $table->string('last_name');

    $table->date('birth_date')->nullable();
    $table->string('address')->nullable();
    $table->string('barangay')->nullable();
    $table->string('municipality')->nullable();
    $table->string('province')->nullable();

    $table->integer('age')->nullable();
    $table->string('gender')->nullable();
    $table->string('valid_id')->nullable();

    $table->enum('status',['applicant','resident','illegal','underinvestigation']);

    $table->foreignId('added_by')->constrained('users');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
