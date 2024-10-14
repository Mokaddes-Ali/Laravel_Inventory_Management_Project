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
            $table->unsignedBigInteger('editor')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');


            $table->foreign('creator')->references('id')->on('users')
                ->cascadeOnUpdate()->restrictOnDelete();
                $table->foreign('editor')->references('id')->on('users')
                ->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('category_id')->references('id')->on('categories')
                ->cascadeOnUpdate()->restrictOnDelete();

            $table->foreign('brand_id')->references('id')->on('brands')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->string('name',100);
            $table->string('code')->nullable()->unique();
            $table->string('price',50);
            $table->string('cost',50);
            $table->string('unit',50);
            $table->string('img_url',100);
            $table->text('details')->nullable();
            $table->string('slug',50)->nullable();
            $table->integer('status')->default(1);

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
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
