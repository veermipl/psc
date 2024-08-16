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
        Schema::create('business_readiness', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable()->default(null);
            $table->string('title')->nullable()->default(null);
            $table->string('image')->nullable()->default(null);
            $table->longText('contant')->nullable()->default(null);
            $table->enum('status', [0, 1])->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
