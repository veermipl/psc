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
        Schema::create('executive_committeess', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable()->default(null);
            $table->string('designation')->nullable()->default(null);
            $table->string('email')->unique()->nullable()->default(null);;
            $table->bigInteger('mobile_number')->nullable()->default(null);
            $table->longText('terms_of_reference')->nullable()->default(null);
            $table->string('facebook')->nullable()->default(null);
            $table->string('twitter')->nullable()->default(null);
            $table->string('instagram')->nullable()->default(null);
            $table->string('dribbble')->nullable()->default(null);
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
