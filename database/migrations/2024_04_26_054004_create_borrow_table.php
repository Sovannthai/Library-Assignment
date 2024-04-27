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
        Schema::create('borrow', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('book_id');
            $table->integer('created_by');
            $table->string('borrow_code')->nullable();
            $table->decimal('deposit_amount',10,2)->nullable();
            $table->decimal('find_amount',10,2)->nullable();
            $table->date('borrow_date')->nullable();
            $table->date('due_date')->nullable();
            $table->date('return_date')->nullable();
            $table->longText('note')->nullable();
            $table->enum('is_return',[1,0])->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrow');
    }
};
