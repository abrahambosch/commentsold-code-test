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
        Schema::create('products', function (Blueprint $table) {
            // "id","product_name","description","style","brand","created_at","updated_at","url","product_type","shipping_price","note","admin_id"
            $table->id();
            $table->string('product_name', 255);
            $table->text('description');
            $table->text('style');
            $table->text('brand');
            $table->string('url', 255);
            $table->string('product_type', 50);
            $table->integer('shipping_price');
            $table->text('note');
            $table->integer('admin_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
