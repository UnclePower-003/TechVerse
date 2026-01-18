<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hero_headers', function (Blueprint $table) {
            $table->id();

            $table->string('badge_text')->nullable();

            $table->string('title_small_1')->nullable(); // YOUR
            $table->string('title_main')->nullable(); // TECH PARTNER
            $table->string('title_small_2')->nullable(); // FOR
            $table->string('title_highlight')->nullable(); // Success

            $table->text('description')->nullable();

            $table->string('primary_btn_text')->nullable();
            $table->string('primary_btn_link')->nullable();

            $table->string('secondary_btn_text')->nullable();
            $table->string('secondary_btn_link')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_headers');
    }
};
