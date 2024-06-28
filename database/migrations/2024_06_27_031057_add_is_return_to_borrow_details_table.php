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
        Schema::table('borrow_details', function (Blueprint $table) {
            $table->enum('is_return',[1,0])->default(0)->after('find_amount');
            $table->integer('customer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borrow_details', function (Blueprint $table) {
            $table->dropColumn('is_return');
            $table->dropColumn('customer_id');
        });
    }
};
