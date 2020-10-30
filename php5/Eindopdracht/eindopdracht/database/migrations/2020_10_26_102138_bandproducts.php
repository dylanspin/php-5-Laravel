<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Bandproducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bandproducts', function (Blueprint $table) {
            $table->id();
            $table->char('productName', 200);
            $table->text('postText');
            $table->text('vidLink');
            $table->text('imgName');
            $table->bigInteger('price');
            $table->bigInteger('basePrice');
            $table->smallInteger('type');
            $table->bigInteger('idPoster');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bandproducts');
    }
}
