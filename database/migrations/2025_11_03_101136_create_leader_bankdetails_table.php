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
        Schema::create('leader_bankdetails', function (Blueprint $table) {
            $table->id();

            $table->string('leader_id');
            $table->string('bank_holder_name');
            $table->string('bank_name');
            $table->string('bank_address')->nullable();
            $table->string('account_number');
            $table->string('routing_number')->nullable();
            $table->string('swift_code')->nullable(); // SWIFT/BIC
            $table->string('account_type')->nullable(); // e.g. savings/current
            $table->text('payment_details')->nullable(); // extra notes

            $table->string('portal_set_id');
            $table->string('group_id');

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leader_bankdetails');
    }
};
