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
        Schema::create('clubs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city');
            $table->integer('point')->default(0);
            $table->integer('match')->default(0);
            $table->integer('win')->default(0);
            $table->integer('lose')->default(0);
            $table->integer('draw')->default(0);
            $table->integer('gm')->default(0);
            $table->integer('gk')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clubs');
    }
};
