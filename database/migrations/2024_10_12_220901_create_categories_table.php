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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('remarks',200)->nullable();
             $table->unsignedBigInteger('creator')->nullable();
            $table->unsignedBigInteger('editor')->nullable();
            $table->string('slug',50)->nullable();
            $table->integer('status')->default(1);

            $table->foreign('creator')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->foreign('editor')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');

        
    }
};
