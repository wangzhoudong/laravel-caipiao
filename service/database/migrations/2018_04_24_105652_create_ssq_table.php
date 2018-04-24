<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSsqTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ssq', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('issue')->unique('idx_issue')->comment('开奖期号');
			$table->date('issue_date')->comment('开奖日期');
			$table->boolean('red1')->comment('红球');
			$table->boolean('red2');
			$table->boolean('red3')->comment('红3');
			$table->boolean('red4')->comment('红4');
			$table->boolean('red5')->comment('红5');
			$table->boolean('red6')->comment('红6');
			$table->boolean('blue')->comment('篮球');
			$table->bigInteger('sales_amount')->nullable();
			$table->integer('first_prize')->nullable()->comment('一等奖');
			$table->string('desc', 128)->nullable();
			$table->char('md5', 32)->nullable()->unique('idx_md5');
			$table->integer('second_prize')->nullable()->comment('二等奖');
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
		Schema::drop('ssq');
	}

}
