<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Inakagua kwanza: Kama column HAIPO, ndiyo inaiweka
        if (!Schema::hasColumn('prediction_feedback', 'prediction_id')) {
            Schema::table('prediction_feedback', function (Blueprint $table) {
                $table->foreignId('prediction_id')->after('user_id')->constrained()->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('prediction_feedback', 'prediction_id')) {
            Schema::table('prediction_feedback', function (Blueprint $table) {
                $table->dropForeign(['prediction_id']);
                $table->dropColumn('prediction_id');
            });
        }
    }
};