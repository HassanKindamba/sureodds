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
        Schema::create('chat_messages', function (Blueprint $table) {

            $table->id();

            // User aliyesend message
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // text / image / link
            $table->string('type')->default('text');

            // Message content
            $table->text('message')->nullable();

            // Image path - itatumika kwa manager pekee
            $table->string('image_path')->nullable();

            // Pinned message
            $table->boolean('is_pinned')->default(false);

            $table->timestamp('pinned_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_messages');
    }
};