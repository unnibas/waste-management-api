<?php

use App\Models\CollectionRequest;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_requests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('collection_point_id')->unsigned();
            $table->text('remark');
            $table->string('urgency');
            $table->string('status')->default(CollectionRequest::PENDING_REQUEST);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('collection_point_id')->references('id')->on('collection_points');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collection_requests');
    }
}
