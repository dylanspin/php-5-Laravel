<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatesReviewsBandProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BandProfiles', function (Blueprint $table) {
            $table->id();
            $table->text('about');
            $table->text('image');
            $table->text('gradient');
            $table->smallInteger('font');
            $table->mediumText('social');
            $table->longText('songTexts');
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
        Schema::dropIfExists('BandProfiles');
    }
}
