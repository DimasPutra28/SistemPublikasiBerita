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
        Schema::create('comentars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained('articles')->onDelete('cascade');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('name_visitor');
            $table->string('email_visitor');
            $table->text('comment');
            $table->boolean('is_published')->default(true);
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('comentars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentars');
    }
};
