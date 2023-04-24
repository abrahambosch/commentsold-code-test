<?php

use App\Models\User;
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
            $table->id();
            $table->string('product_name', 255);
            $table->text('description');
            $table->text('style');
            $table->text('brand');
            $table->string('url', 255)->nullable();
            $table->string('product_type', 50);
            $table->integer('shipping_price');
            $table->text('note')->nullable();
            $table->foreignIdFor(User::class,  'admin_id');
            $table->foreign('admin_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
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
