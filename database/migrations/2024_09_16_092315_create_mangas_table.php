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
        Schema::create('mangas', function (Blueprint $table) {
            $table->id();
            $table->string('manga_title', 45);
            $table->string('image')->nullable();
            $table->string('manga_story', 1000);
            $table->unsignedBigInteger('Id_pubilsher'); 
            $table->unsignedBigInteger('Id_type'); 

            $table->timestamps();
            $table->softDeletes();

            // Define foreign key relationship

            $table->foreign('Id_pubilsher')->references('id')->on('pubilshers')->onDelete('cascade');
            $table->foreign('Id_type')->references('id')->on('type_mangas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mangas');
    }
};
