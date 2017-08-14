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
            $table->unsignedInteger('sender');
            $table->unsignedInteger('receiver');
            $table->string('type',16);
            $table->timestamp('prepaired_on');
            $table->timestamp('signed_on')->nullable();
            $table->timestamps();

            $table->foreign('sender')->references('id')->on('organizations')->onDelete('cascade');
            $table->foreign('receiver')->references('id')->on('organizations')->onDelete('cascade');
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
