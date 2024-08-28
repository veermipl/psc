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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->longText('profile_image')->nullable()->default(null);
            $table->longText('background_image')->nullable()->default(null);
            $table->longText('connect_url')->nullable()->default(null);
            $table->longText('connect_fb')->nullable()->default(null);
            $table->longText('connect_twitter')->nullable()->default(null);
            $table->longText('connect_linkedin')->nullable()->default(null);
            $table->longText('location')->nullable()->default(null);
            $table->longText('address')->nullable()->default(null);
            $table->longText('about_me')->nullable()->default(null);
            $table->enum('gender', ['male', 'female'])->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
