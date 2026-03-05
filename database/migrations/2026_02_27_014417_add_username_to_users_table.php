<!----database/migrations/2026_02_27_014417_add_username_to_users_table--->
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
        // Only add the username column if it doesn't exist
        if (!Schema::hasColumn('users', 'username')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('username', 100)->unique()->nullable()->after('email');
            });
             
            // Log success
            \Illuminate\Support\Facades\Log::info('Username column added to users table');
        } else {
            \Illuminate\Support\Facades\Log::info('Username column already exists in users table');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('users', 'username')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('username');
            });
        }   
    }
};