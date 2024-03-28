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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /
     
• Run the migrations.*/
  public function up(): void{Schema::create('loans', function (Blueprint $table) {$table->id();$table->unsignedBigInteger('book_id');$table->unsignedBigInteger('member_id');$table->date('loanDate')->default(now());$table->date('dueDate')->nullable();$table->timestamps();

            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
        });
    }

    /
     
• Reverse the migrations.*/
  public function down(): void{Schema::dropIfExists('loans');}
};