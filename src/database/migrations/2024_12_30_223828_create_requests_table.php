<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned()->nullable('false');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('attendance_id')->unsigned()->nullable('false');
            $table->foreign('attendance_id')->references('id')->on('attendances');
            $table->string('status')->nullable('false');
            $table->string('reason')->nullable('false');
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
        Schema::dropIfExists('requests');
    }
}
