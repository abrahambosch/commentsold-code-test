<?php

use App\Models\InventoryItem;
use App\Models\Product;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(InventoryItem::class,  'inventory_id');
            $table->foreign('inventory_id')->references('id')->on('inventory_items');
            $table->foreignIdFor(Product::class);
            $table->foreign('product_id')->references('id')->on('products');
            $table->text("street_address"); 
            $table->text("apartment"); 
            $table->text("city"); 
            $table->text("state"); 
            $table->string("country_code", 10); 
            $table->text("zip"); 
            $table->string("phone_number", 20); 
            $table->text("email"); 
            $table->string("name", 100); 
            $table->string("order_status", 50); 
            $table->text("payment_ref"); 
            $table->string("transaction_id"); 
            $table->integer("payment_amt_cents")->default(0); 
            $table->integer("ship_charged_cents")->default(0); 
            $table->integer("ship_cost_cents")->default(0); 
            $table->integer("subtotal_cents")->default(0); 
            $table->integer("total_cents")->default(0); 
            $table->text("shipper_name"); 
            $table->timestamp("payment_date"); 
            $table->timestamp("shipped_date"); 
            $table->text("tracking_number");
            $table->integer("tax_total_cents")->default(0); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
