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
    Schema::create('homes', function (Blueprint $table) {
        $table->id();

        // CONTENT
        $table->string('title')->nullable();
        $table->text('description')->nullable();

        // STATS (manager ata-fill)
        $table->string('stat_accuracy_label')->nullable();
        $table->string('stat_accuracy_value')->nullable();

        $table->string('stat_members_label')->nullable();
        $table->string('stat_members_value')->nullable();

        $table->string('stat_picks_label')->nullable();
        $table->string('stat_picks_value')->nullable();

        $table->string('stat_experience_label')->nullable();
        $table->string('stat_experience_value')->nullable();

        // IMAGE
        $table->string('image')->nullable();

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_contents');
    }
};
