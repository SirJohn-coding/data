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
        Schema::create('rental_details', function (Blueprint $table) {

            $table->unsignedBigInteger('id_rental');
            $table->unsignedBigInteger('id_user_manga');
            $table->unsignedBigInteger('id_Manga')->nullable();
            $table->unsignedBigInteger('id_volume');

            $table->float('rent_price');
            $table->integer('amount_manga')->default(1);
            $table->integer('status')->default(1);

            $table->timestamps();
            $table->softDeletes();

            // Define foreign key relationship
            $table->foreign('id_rental')->references('id')->on('rentals')->onDelete('cascade');
            $table->foreign('id_user_manga')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_Manga')->references('id')->on('mangas')->onDelete('cascade');
            $table->foreign('id_volume')->references('id')->on('volumes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_details');
    }
};
