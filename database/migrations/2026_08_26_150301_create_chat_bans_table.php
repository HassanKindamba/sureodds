<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chat_bans', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('blocked_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('reason')->nullable();

            $table->timestamp('blocked_at')->useCurrent();

            // Ban inaweza kuwa temporary au permanent
            $table->timestamp('expires_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chat_bans');
    }
};