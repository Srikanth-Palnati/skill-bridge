<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@user.com',
            'password' => '$2y$10$/22InpjshaFlgo2OrMuLD.MbbE5yJEw8igRyObZD7zBmXUQuxT2ra', // Always hash passwords!
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('users')->where('email', 'admin@user.com')->delete();
    }
};
