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
            $table->id();
            $table->unsignedBigInteger('creator');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');

            $table->foreign('creator')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('brand_id')->references('id')->on('brands');

            $table->string('name');
            $table->string('code')->unique();
            $table->decimal('price', 8, 2);
            $table->decimal('cost', 8, 2);
            $table->integer('unit');
            $table->string('img_url')->nullable();
            $table->text('details')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema:: dropIfExists('users');
        Schema:: dropIfExists('categories');
        Schema:: dropIfExists('brands');
    }
};
