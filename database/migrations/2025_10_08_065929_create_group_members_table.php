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
        Schema::create('group_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->decimal('weekly_commitment', 10, 2); // Amount user commits to pay weekly
            $table->decimal('total_contributed', 10, 2)->default(0);
            $table->decimal('group_sare', 10, 2)->default(0);
            $table->boolean('has_recived')->default(false);
            $table->decimal('recived_amount', 10, 2)->default(0);
            $table->date('recived_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_members');
    }
};
