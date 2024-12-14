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
    Schema::create('users', function (Blueprint $table) {
        $table->id('ID');
        $table->string('user_login')->unique();
        $table->string('password'); // Password field
        $table->string('user_nicename');
        $table->string('email')->unique(); // Email field
        $table->string('user_url')->nullable();
        $table->dateTime('user_registered')->nullable();
        $table->string('user_activation_key')->nullable();
        $table->integer('user_status')->default(0);
        $table->string('display_name')->nullable();
        $table->enum('role', ['admin', 'user'])->default('user');
        $table->rememberToken(); // For "remember me" functionality
        $table->timestamps(); // created_at and updated_at
    });



    Schema::create('password_reset_tokens', function (Blueprint $table) {
        $table->string('email')->primary();
        $table->string('token');
        $table->timestamp('created_at')->nullable();
    });

    Schema::create('sessions', function (Blueprint $table) {
        $table->string('id')->primary();
        $table->foreignId('user_id')->nullable()->index();
        $table->string('ip_address', 45)->nullable();
        $table->text('user_agent')->nullable();
        $table->longText('payload');
        $table->integer('last_activity')->index();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
