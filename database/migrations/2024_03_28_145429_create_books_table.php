<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->year('publishyear')->default(date('Y'))->min(1900)->max(now()->year);
            $table->Integer('edition')->default(1)->min(1)->max(5);
            $table->string('isbn', 13);
            $table->boolean('loanable')->default(true);
            $table->timestamps();
            $table->softDeletes();
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
