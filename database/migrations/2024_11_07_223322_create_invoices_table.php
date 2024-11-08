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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();



            $table->string('discount',50)->default(0);
            $table->string('vat',50);
            $table->string('payable',50);
            $table->string('paid',50);
			$table->string('due',50);


            $table->unsignedBigInteger('creator');
            $table->unsignedBigInteger('editor')->nullable();
            $table->unsignedBigInteger('customer_id');

            $table->foreign('creator')->references('id')->on('users')
            ->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('editor')->references('id')->on('users')
            ->cascadeOnUpdate()->restrictOnDelete();

            $table->foreign('customer_id')->references('id')->on('customers')
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
        Schema::dropIfExists('invoices');
    }
};
