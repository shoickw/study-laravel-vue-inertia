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
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(true)->default(0);
            $table->string('task_name')->nullable(true)->default(null);
            $table->string('description')->nullable(true)->default(null);
            $table->tinyInteger('status')->nullable(true)->default(1)->comment('1.未対応, 2.対応中, 3.完了, 9.キャンセル');
            $table->timestamp('completed_at')->nullable(true)->default(null);
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
        Schema::dropIfExists('tasks');
    }
}
