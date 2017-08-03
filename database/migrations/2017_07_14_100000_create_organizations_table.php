<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('desc')->nullable();
            $table->string('license')->nullable();
            $table->string('country')->nullable();
            $table->string('location')->nullable();
            $table->unsignedInteger('archive_id');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('archive_id')->references('id')->on('archives');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations');
    }
}
