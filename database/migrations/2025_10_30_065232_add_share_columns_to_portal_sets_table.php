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
        Schema::table('portal_sets', function (Blueprint $table) {
            //
            $table->decimal('share_price', 10, 2)->nullable()->after('target_amount');
            $table->unsignedInteger('number_of_shares')->nullable()->after('share_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('portal_sets', function (Blueprint $table) {
            //
             $table->dropColumn(['share_price', 'number_of_shares']);
        });
            
    }
};
