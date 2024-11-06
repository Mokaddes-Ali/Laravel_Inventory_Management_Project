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
        Schema::create('brands', function (Blueprint $table) {

            $table->id();
            $table->string('brandName',50);
            $table->string('brandImg', 300)->nullable();
            $table->unsignedBigInteger('creator');
            $table->unsignedBigInteger('editor')->nullable();

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
        Schema::dropIfExists('brands');
        Schema:: dropIfExists('users');

    }
};
