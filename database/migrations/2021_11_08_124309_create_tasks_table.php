<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true);
            $table->string('name');
            $table->tinyInteger('status')->default(1)
            ->comment('1: 未着手 2: 進行中 3: 完了');
            $table->string('priority', 5)->commnet('優先度: A~D');
            $table->date('timelimit');
            $table->softDeletes();
            $table->timestamps('create_at')->default(DB::raw('CURRENT_TIMESTMP'));
            $table->timestamps('updated_at')->default(DB::raw('CURRENT_TIMESTMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
