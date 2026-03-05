<!---database/migrations/2026_02_26_082939_create_archived_users_table---->
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
        Schema::create('archived_users', function (Blueprint $table) {
            $table->id('archive_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('suffix')->nullable();
            $table->string('email');
            $table->string('position')->nullable();
            $table->json('archived_data')->nullable();
            $table->unsignedBigInteger('archived_by')->nullable();
            
            // Make both timestamps nullable to avoid default value issues
            $table->timestamp('archived_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            
            $table->timestamps();
            
            // Add foreign keys
            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('set null');
                  
            $table->foreign('archived_by')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archived_users');
    }
};