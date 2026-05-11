<!--database/migrations/2026_05_08_044252_create_announcements_table.php-->
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content');
            $table->string('image')->nullable();
            $table->enum('status', ['draft', 'published', 'scheduled'])->default('draft');
            $table->unsignedBigInteger('author_id');
            $table->dateTime('scheduled_date')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->timestamps();

            // Foreign key to users table
            $table->foreign('author_id')
                ->references('user_id')
                ->on('users')
                ->onDelete('cascade');

            // Indexes for better performance
            $table->index('status');
            $table->index('author_id');
            $table->index('scheduled_date');
            $table->index('published_at');
            $table->index(['status', 'published_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
