<?php

use App\Models\User;
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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();

            $table->string('name', 80);
            $table->string('title');

            $table->string('picture_path')->nullable();
            $table->enum('type', \App\Models\Profile::$profileType);
            $table->string('about', 500)->nullable();

            $table->string('location')->nullable();
            $table->enum('category_1', \App\Models\Job::$jobCategory)->nullable();
            $table->enum('category_2', \App\Models\Job::$jobCategory)->nullable();
            $table->enum('category_3', \App\Models\Job::$jobCategory)->nullable();

            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
