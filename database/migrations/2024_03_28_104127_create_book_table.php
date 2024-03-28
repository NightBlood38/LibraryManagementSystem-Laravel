<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{

    public function up(): void
    {
        /**
         * Run the migrations.
         */
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('author', 30);
            $table->string('title', 100);
            $table->string('publisher', 50);
            $table->integer('publishyear')->nullable()->default(date('Y'));
            $table->integer('edition')->nullable()->default(1);
            $table->integer('isbn');
            $table->boolean('borrowable')->default(true);
            $table->timestamps();
        });

    }

    public function down(): void
    {
        /**
         * Reverse the migrations.
         */
        Schema::dropIfExists('books');
    }
};
