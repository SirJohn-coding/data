<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rental_statuses', function (Blueprint $table) {
            $table->id();

            $table->integer('recive_status')->default(0);
            $table->integer('waiting_status')->default(1);
            $table->integer('Notrecive_status')->default(1);


            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rental_statuses');
    }
};
