<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscussionParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussion_participants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employee_id')->index();
            $table->integer('discussion_id')->index();
            $table->tinyInteger('closed')->default('0');//0 = open, 1 = closed
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
        Schema::dropIfExists('discussion_participants');
    }
}
