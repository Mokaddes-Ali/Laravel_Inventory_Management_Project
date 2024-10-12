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
        Schema::create('projects', function (Blueprint $table) {

            $table->id();
            $table->string('project_name')-> unique(); //its sensitive for add project
            $table->unsignedBigInteger('client_id');
            $table->text('description')->nullable();
            $table->decimal('project_value', 20, 2);
            $table->decimal('paid_amount', 20, 2)->nullable();
            $table->decimal('due_amount', 20, 2)->nullable();
            $table->unsignedBigInteger('creator')->nullable();
            $table->unsignedBigInteger('editor')->nullable();
            $table->string('slug', 50)->nullable();
            $table->decimal('expense_amount', 20, 2)->nullable();
            $table->date('date')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();

            // Foreign key constraints with cascadeOnUpdate and restrictOnDelete
            $table->foreign('client_id')
                  ->references('id')
                  ->on('clients')
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
        Schema::dropIfExists('projects');
    }
};
