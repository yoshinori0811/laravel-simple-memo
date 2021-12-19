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
            $table->string('task_name');
            $table->tinyInteger('status')->default(1)
            ->comment('1: 未着手 2: 進行中 3: 完了');
            $table->string('priority', 5)->commnet('優先度: A~D');
            $table->date('timelimit')->comment('yyyy/mm/dd');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->timestamp('create_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
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
