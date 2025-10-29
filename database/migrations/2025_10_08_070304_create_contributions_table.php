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
        Schema::create('contributions', function (Blueprint $table) {
             $table->id();
    $table->foreignId('group_id')->constrained();
    $table->foreignId('user_id')->constrained();
    $table->integer('week_number');
    $table->decimal('amount', 10, 2);
    $table->date('contribution_date');
    $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
    $table->string('payment_method')->nullable();
    $table->string('transaction_id')->nullable();
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contributions');
    }
};
