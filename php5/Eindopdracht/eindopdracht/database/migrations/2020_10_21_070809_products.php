<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->text('postText');
            $table->text('vidLink');
            $table->text('imgName');
            $table->smallInteger('price');
            $table->smallInteger('basePrice');
            $table->boolean('hour');
            $table->boolean('discus');
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
        Schema::dropIfExists('posts');
    }
}
