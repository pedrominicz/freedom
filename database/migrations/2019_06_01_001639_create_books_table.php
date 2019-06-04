<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::dropIfExists('books');

    Schema::create('books', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('title');
      $table->string('author')->nullable();
      $table->string('synopsis', 2000)->nullable();
      $table->string('file');
      $table->string('cover')->nullable();
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
    Schema::dropIfExists('books');
  }
}
