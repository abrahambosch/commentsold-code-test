<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{


    /**
id int 
product_id int 
street_address text 
apartment text
city text 
state text 
country_code string 
zip text 
phone_number string 
email text 
name string 
order_status string 
payment_ref text 
transaction_id string 
payment_amt_cents int 
ship_charged_cents int 
ship_cost_cents int 
subtotal_cents int 
total_cents int 
shipper_name text 
payment_date timestamp 
shipped_date timestamp 
tracking_number text 
tax_total_cents int 
created_at timestamp 
updated_at timestamp

     */
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer("inventory_id"); 
            $table->integer("product_id"); 
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
