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
        Schema::create('catelog', function (Blueprint $table) {
            $table->id();
            $table->string('cate_code')->nullable();
            $table->string('cate_name')->nullable();
            $table->string('isbn')->nullable();
            $table->string('author_name')->nullable();
            $table->string('publisher')->nullable();
            $table->date('publishyear')->nullable();
            $table->string('publish_edition')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catelog');
    }
};
