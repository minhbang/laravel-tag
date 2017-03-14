<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('tags', function (Blueprint $table) {
          $table->increments('id');
          $table->json('name');
          $table->json('slug');
          $table->string('type')->nullable();
          $table->integer('order_column')->nullable();
          $table->timestamps();
      });

      Schema::create('taggables', function (Blueprint $table) {
          $table->integer('tag_id')->unsigned();
          $table->integer('taggable_id')->unsigned();
          $table->string('taggable_type');

          $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('taggables');
    }
}
