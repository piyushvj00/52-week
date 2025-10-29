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
        Schema::create('portal_sets', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., '2025 Committee Set'
            $table->integer('total_portals')->default(52);
            $table->decimal('target_amount', 10, 2);

            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portal_sets');
    }
};
