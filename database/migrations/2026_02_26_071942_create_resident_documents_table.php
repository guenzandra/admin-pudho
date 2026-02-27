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
        Schema::create('resident_documents', function (Blueprint $table) {
    $table->id();

    $table->foreignId('resident_id')->constrained('residents');
    $table->foreignId('required_document_id')->constrained('required_documents');
    $table->foreignId('file_id')->constrained('file_storage');

    $table->string('status')->nullable();
    $table->foreignId('verified_by')->nullable()->constrained('users');

    $table->timestamp('uploaded_at')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resident_documents');
    }
};
