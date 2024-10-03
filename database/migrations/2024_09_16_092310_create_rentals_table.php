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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id(); // ใช้ auto_increment เฉพาะกับคอลัมน์ id
            $table->integer('status')->default(1);
            $table->integer('rental_day')->nullable();
            $table->integer('total_manga')->nullable();
            $table->float('total_rent')->nullable();
            $table->integer('penalty_rental')->nullable();
            $table->dateTime('date_rent')->nullable();   //วันสั่งเช่า
            $table->dateTime('date_keep')->nullable(); //วันมารับ
            $table->dateTime('date_due')->nullable(); //วันคืน
            $table->dateTime('date_return')->nullable(); //วันคืน
            $table->unsignedBigInteger('Id_user_manga');
            $table->unsignedBigInteger('Id_status');

            $table->timestamps();
            $table->softDeletes();

            // Define foreign key relationship
            $table->foreign('Id_user_manga')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('Id_status')->references('id')->on('faqs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
