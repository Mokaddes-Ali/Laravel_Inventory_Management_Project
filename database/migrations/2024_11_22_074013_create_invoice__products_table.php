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
        Schema::create('invoice__products', function (Blueprint $table) {
            $table->id();
           
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('product_id');
           

            $table->string('qty',50);
            $table->string('sale_price',50);
			$table->string('subtotal',50)->nullable()->default(0);

            $table->unsignedBigInteger('creator');
            $table->unsignedBigInteger('editor')->nullable();
            $table->string('slug',50)->nullable();
            $table->integer('status')->default(1);


            $table->foreign('invoice_id')->references('id')->on('invoices')
                ->cascadeOnUpdate()->restrictOnDelete();

            $table->foreign('product_id')->references('id')->on('products')
                ->cascadeOnUpdate()->restrictOnDelete();
 
                
               
    
                $table->foreign('creator')->references('id')->on('users')
                    ->cascadeOnUpdate()->restrictOnDelete();
                    $table->foreign('editor')->references('id')->on('users')
                    ->cascadeOnUpdate()->restrictOnDelete();


            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice__products');
    }
};
