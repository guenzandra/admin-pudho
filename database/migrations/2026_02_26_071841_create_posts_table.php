<!--/**2026_02_26_071841_create_posts_table**/-->
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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            // Reference users table with custom primary key 'user_id'
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('cascade');

            // Reference categories table (uses default 'id' primary key)
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('set null');

            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('media_path')->nullable();

            $table->enum('status', ['publish', 'draft', 'deleted'])->default('draft');

            $table->timestamps();
            
            // Add indexes for better performance
            $table->index('user_id');
            $table->index('category_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};