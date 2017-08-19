<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ref',124)->unique();
            $table->string('title');
            $table->text('desc')->nullable();
            $table->string('type',16);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('folder_id');
            $table->unsignedInteger('organization_id');
            $table->timestamp('written_on');
            $table->timestamp('signed_on');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');//->onDelete('cascade');
            $table->foreign('folder_id')->references('id')->on('folders')->onDelete('cascade');
            $table->foreign('organization_id')->references('id')->on('organizations');//->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
