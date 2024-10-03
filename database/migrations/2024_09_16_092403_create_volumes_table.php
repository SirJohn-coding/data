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
        Schema::create('volumes', function (Blueprint $table) {
            $table->id();
            $table->integer('No_volume');
            $table->string('image_volume', 255);
            $table->integer('Price');
            $table->float('Price_Rental', 8, 2); // ปรับเป็น 8,2 แทน float(53) เพื่อให้เหมาะสมกว่า
            $table->integer('status'); // ลบ auto_increment ออก
            $table->unsignedBigInteger('Id_Manga');
            $table->unsignedBigInteger('Id_location');

            $table->timestamps();
            $table->softDeletes();

            // Define foreign key relationship
            $table->foreign('Id_Manga')->references('id')->on('mangas')->onDelete('cascade');
            $table->foreign('Id_location')->references('id')->on('locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volumes');
    }
};
