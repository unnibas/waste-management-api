<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_points', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sub_area_id')->unsigned();
            $table->string('name');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('card_id');
            $table->string('phone');
            $table->string('email');
            $table->string('barcode');
            $table->text('address');
            $table->string('pincode');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('sub_area_id')->references('id')->on('sub_areas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collection_points');
    }
}
