<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ref',64)->unique();
            $table->string('title');
            $table->string('desc')->nullable();
            $table->unsignedInteger('sender');
            $table->unsignedInteger('reciver');
            $table->string('type',8);
            $table->string('ext',32);
            $table->timestamp('prepaired');
            $table->timestamp('signed')->nullable();
            $table->string('status', 20)->default('pending');
            $table->timestamps();

            $table->foreign('sender')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reciver')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
