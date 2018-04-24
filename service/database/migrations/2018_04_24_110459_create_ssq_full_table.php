<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSsqFullTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ssq_full', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->boolean('red1');
			$table->boolean('red2');
			$table->boolean('red3');
			$table->boolean('red4');
			$table->boolean('red5');
			$table->boolean('red6');
			$table->boolean('blue');
			$table->char('desc', 64)->nullable();
			$table->char('md5', 32)->unique('idx_md5');
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
		Schema::drop('ssq_full');
	}

}
