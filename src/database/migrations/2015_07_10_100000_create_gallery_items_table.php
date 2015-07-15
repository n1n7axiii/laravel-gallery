<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gallery_items', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->string('image');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->integer('position')->unsigned();
            $table->tinyInteger('highlight')->default(0);
			$table->timestamps();

            $table->index('title');
            $table->foreign('category_id')->references('id')->on('gallery_categories')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('gallery_items');
	}

}
