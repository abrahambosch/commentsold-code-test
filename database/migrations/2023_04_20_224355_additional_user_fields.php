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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('superadmin');
            $table->string('shop_name', 50);
            $table->string('card_brand', 10);
            $table->string('card_last_four', 4);
            $table->timestamp('trial_ends_at')->nullable();
            $table->string('shop_domain', 255);
            $table->boolean('is_enabled')->default(true);
            $table->string('billing_plan', 50);
            $table->timestamp('trial_starts_at');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('superadmin');
            $table->dropColumn('shop_name');
            $table->dropColumn('card_brand');
            $table->dropColumn('card_last_four');
            $table->dropColumn('trial_ends_at');
            $table->dropColumn('shop_domain');
            $table->dropColumn('is_enabled');
            $table->dropColumn('billing_plan');
            $table->dropColumn('trial_starts_at');
        });
    }
};
