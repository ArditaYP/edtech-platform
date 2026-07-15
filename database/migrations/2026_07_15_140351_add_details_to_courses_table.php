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
        Schema::table('courses', function (Blueprint $table) {
            $table->integer('price')->default(0);
            $table->json('learning_paths')->nullable();
            $table->json('topics')->nullable();
            $table->json('benefits')->nullable();
            $table->string('promo_title')->nullable();
            $table->date('promo_end_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn([
                'price',
                'learning_paths',
                'topics',
                'benefits',
                'promo_title',
                'promo_end_date',
            ]);
        });
    }
};
