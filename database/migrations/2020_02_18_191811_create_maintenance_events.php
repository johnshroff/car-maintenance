<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenanceEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

			$table->integer('car_id')->unsigned();
			$table->integer('mileage')->unsigned()->nullable();
			$table->string('business_name')->nullable();
			$table->integer('maintenance_service_id')->unsigned();


			$table->foreign('car_id')
				->references('id')
				->on('cars');

			$table->foreign('maintenance_service_id')
				->references('id')
				->on('maintenance_services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maintenance_events');
    }
}
