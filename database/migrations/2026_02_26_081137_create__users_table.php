<!--database/migrations/2026_02_26_081137_create__users_table--->

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
        // Create users table
        Schema::create('users', function (Blueprint $table) {
            // Primary key
            $table->id('user_id'); // primary key (user_id) instead of just 'id'
            
            // Personal Information
            $table->string('first_name')->default('Anonymous');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('suffix')->nullable(); // Jr., Sr., III, etc.
            
            // Contact Information
            $table->string('contact_no', 20)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            
            // Demographic Information
            $table->date('birthdate')->nullable();
            $table->integer('age')->nullable()->virtualAs('TIMESTAMPDIFF(YEAR, birthdate, CURDATE())', 'mysql');
            $table->enum('gender', ['male', 'female', 'other', 'prefer_not_to_say'])->nullable();
            
            // Address Information
            $table->string('address')->nullable();
            $table->string('province', 100)->nullable();
            $table->string('municipality', 100)->nullable();
            $table->string('barangay', 100)->nullable();
            $table->string('zip_code', 10)->nullable();
            
            // Profile
            $table->string('profile_img')->nullable();
            $table->text('bio')->nullable();
            
            // Role and Position
            $table->unsignedTinyInteger('role_no')->default(4)
                  ->comment('1=admin, 2=editor, 3=staff, 4=app_user');
            $table->string('position', 100)->nullable();
            
            // Authentication
            $table->string('password')->nullable()
                  ->comment('Nullable because anonymous app users don\'t need password');
            $table->rememberToken();
            
            // Status Flags
            $table->boolean('is_anonymous')->default(true)
                  ->comment('True for app users, false for registered staff/admin');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_verified')->default(false);
            $table->timestamp('verified_at')->nullable();
            $table->unsignedBigInteger('verified_by')->nullable();
            
            // Metadata
            $table->string('timezone', 50)->nullable()->default('Asia/Manila');
            $table->string('locale', 10)->nullable()->default('en');
            $table->ipAddress('last_login_ip')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->integer('login_attempts')->default(0);
            $table->timestamp('locked_until')->nullable();
            
            // Audit Timestamps
            $table->timestamps(); // created_at and updated_at
            $table->softDeletes(); // deleted_at for soft deletes
            
            // Indexes for performance
            $table->index('role_no');
            $table->index('is_anonymous');
            $table->index('is_active');
            $table->index('barangay');
            $table->index('municipality');
            $table->index('province');
            $table->index('last_name');
            $table->index('created_at');
            
            // Composite indexes
            $table->index(['role_no', 'is_active']);
            $table->index(['barangay', 'municipality']);
            
            // Foreign key constraints
            $table->foreign('verified_by')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('set null');
        });

        // Password reset tokens table
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->index('expires_at');
        });

        // Sessions table for logged-in users
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
            
            // Add foreign key constraint
            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('cascade');
        });

        // User activity logs table
        Schema::create('user_activity_logs', function (Blueprint $table) {
            $table->id('log_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('action', 100);
            $table->string('entity_type', 50)->nullable();
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->text('description')->nullable();
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('set null');
                  
            $table->index(['user_id', 'created_at']);
            $table->index(['entity_type', 'entity_id']);
            $table->index('action');
        });

        // User notifications table
        Schema::create('user_notifications', function (Blueprint $table) {
            $table->id('notification_id');
            $table->unsignedBigInteger('user_id');
            $table->string('type', 50); // info, warning, success, error
            $table->string('title');
            $table->text('message');
            $table->json('data')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('cascade');
                  
            $table->index(['user_id', 'read_at']);
            $table->index('created_at');
        });

        // User devices table (for push notifications)
        Schema::create('user_devices', function (Blueprint $table) {
            $table->id('device_id');
            $table->unsignedBigInteger('user_id');
            $table->string('device_token')->unique();
            $table->string('device_type', 20); // android, ios, web
            $table->string('device_name')->nullable();
            $table->string('app_version')->nullable();
            $table->string('os_version')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_used_at')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('cascade');
                  
            $table->index(['user_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop in reverse order to avoid foreign key constraints
        Schema::dropIfExists('user_devices');
        Schema::dropIfExists('user_notifications');
        Schema::dropIfExists('user_activity_logs');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};