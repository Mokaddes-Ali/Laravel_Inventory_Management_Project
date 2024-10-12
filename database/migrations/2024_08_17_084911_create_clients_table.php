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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('number')->nullable();
            $table->string('address')->nullable();
            $table->string('pic')->nullable();
            $table->unsignedBigInteger('creator')->nullable();
            $table->unsignedBigInteger('editor')->nullable();
            $table->string('slug', 50)->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();

                // Foreign key constraints with cascadeOnUpdate and restrictOnDelete
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

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
