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
        Schema::create('wpvo_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_author')->constrained('wpvo_users')->onDelete('cascade'); // Relasi ke tabel users
            $table->dateTime('post_date');
            $table->dateTime('post_date_gmt');
            $table->longtext('post_content');
            $table->text('post_title');
            $table->text('post_excerpt');
            $table->string('post_status',20)->default('draft');
            $table->string('comment_status',20)->default('open');
            $table->string('ping_status',20)->default('open');
            $table->string('post_password')->default('');
            $table->string('post_name',200);
            $table->text('to_ping')->default('');
            $table->text('pinged')->default('');
            $table->dateTime('post_modified')->nullable(); // Bisa kosong (NULL) sebagai default awal
            $table->dateTime('post_modified_gmt')->nullable();
            $table->longtext('post_content_filtered')->default('');
            $table->bigInteger('post_parent')->default(0);
            $table->string('guid')->default('');
            $table->integer('menu_order')->default(0);
            $table->string('post_type', 20)->default('post');
            $table->string('post_mime_type', 100)->default('');
            $table->bigInteger('comment_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wpvo_posts');
    }
};
