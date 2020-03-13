<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBookingsTable extends Migration {

	public function up()
	{
		Schema::create('bookings', function(Blueprint $table) {
			$table->increments('id');
			$table->unsignedBigInteger('cleaner_id');
			$table->foreign('cleaner_id')->references('id')->on('cleaners')
				->onDelete('restrict')
				->onUpdate('restrict');
			$table->unsignedBigInteger('client_id');
			$table->foreign('client_id')->references('id')->on('clients')
				->onDelete('restrict')
				->onUpdate('restrict');
			$table->unsignedBigInteger('vehicule_id');
			$table->foreign('vehicule_id')->references('id')->on('vehicules')
				->onDelete('restrict')
				->onUpdate('restrict');
//			$table->datetime('clean_datetime');
			$table->string('location');
			$table->decimal('bill_amount', 65);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('bookings');
	}
}