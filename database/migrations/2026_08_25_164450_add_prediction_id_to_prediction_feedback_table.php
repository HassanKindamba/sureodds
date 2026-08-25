<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('prediction_feedback', function (Blueprint $table) {
            $table->foreignId('prediction_id')
                ->after('user_id')
                ->constrained('predictions')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('prediction_feedback', function (Blueprint $table) {
            $table->dropForeign(['prediction_id']);
            $table->dropColumn('prediction_id');
        });
    }
};