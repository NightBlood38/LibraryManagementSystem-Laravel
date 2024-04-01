<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
    // only non-borrowed books can be deleted (restrict)
    $table->foreignId('book_id')->constrained()->onUpdate('cascade')->onDelete('restrict'); 
    // if a member is deleted then his/her loans are deleted (cascade)
    $table->foreignId('member_id')->constrained()->onUpdate('cascade')->onDelete('cascade'); 
    // loan date default value: current date
    $table->date('loan_date')->default(now());
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
