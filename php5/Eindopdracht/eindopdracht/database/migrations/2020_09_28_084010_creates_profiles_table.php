<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatesProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ProfileId');
            $table->bigInteger('BandId');
            $table->text('about');
            $table->text('image');
            $table->text('socialMedia');
            $table->text('gradient');
            $table->text('hover');
            $table->smallInteger('font');
            $table->smallInteger('completed');
            $table->smallInteger('failed');
            $table->mediumText('social');
            $table->text('bands');
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
        Schema::dropIfExists('profiles');
    }
}
