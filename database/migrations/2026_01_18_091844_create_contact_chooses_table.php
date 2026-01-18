<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contact_chooses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('icon'); // Font Awesome class
            $table->text('description');
            $table->integer('order')->default(0); // To control order of cards
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_chooses');
    }
};
