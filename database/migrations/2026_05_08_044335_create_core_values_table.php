<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('core_values', function (Blueprint $table) {
            $table->id();
            $table->longText('content');
            $table->unsignedBigInteger('author_id');
            $table->string('value_title')->nullable(); // Optional: Individual core value titles
            $table->integer('order')->default(0); // For sorting multiple core values
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Foreign key to users table
            $table->foreign('author_id')
                ->references('user_id')
                ->on('users')
                ->onDelete('cascade');

            // Indexes
            $table->index('author_id');
            $table->index('is_active');
            $table->index('order');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('core_values');
    }
};
