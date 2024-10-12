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
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->date('date')->nullable();
            $table->decimal('income_amount', 20, 2);
            $table->string('bank_account_id')->nullable();
            $table->text('note')->nullable();
            $table->unsignedBigInteger('creator')->nullable();
            $table->unsignedBigInteger('editor')->nullable();
            $table->string('slug', 50)->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();

            // Foreign key constraints with cascadeOnUpdate and restrictOnDelete
            $table->foreign('project_id')
                  ->references('id')
                  ->on('projects')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

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
        Schema::dropIfExists('incomes');
    }
};
