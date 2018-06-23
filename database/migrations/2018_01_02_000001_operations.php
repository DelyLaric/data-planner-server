<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class Operations extends Migration
{
	public function up()
	{
		Schema::create('_log.operations', function($table) {
			$table->increments('id');
			$table->timestamp('operated_at')->useCurrent();

			$table->string('type');
			$table->string('namespace');

			$table->integer('operator_id');
			$table->boolean('is_confirmed')->default(false);
			$table->integer('confirmer_id')->nullable();
			$table->integer('confirmed_at')->nullable();

			$table->jsonb('params')->nullable();
		});

		Schema::create('_log.snapshots', function($table) {
			$table->increments('id');
			$table->integer('operation_id');
			$table->string('table');
			$table->string('data_id');
			$table->jsonb('data');

			$table->index('operation_id');
			$table->index('table');
		});
	}

	public function down()
	{
		Schema::drop('_log.operations');
		Schema::drop('_log.snapshots');
	}
}
