<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->id(); // This sets the 'id' column as auto-incrementing primary key
            $table->string('MealName', 255);
            $table->longText('Description');
            $table->integer('Price');
            $table->integer('Quantity');
            $table->longText('Ingredients');
            $table->integer('PreparationTime');
            $table->string('MealImage', 255);
            $table
                ->foreignId('Category_Id')
                ->constrained('categories')
                ->onDelete('cascade');
            $table
                ->foreignId('Cook_Id')
                ->constrained('chefs')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meals');
    }
};
