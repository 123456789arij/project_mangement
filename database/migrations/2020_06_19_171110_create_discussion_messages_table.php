<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscussionMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussion_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('content');
            $table->integer('discussion_id')->index();
            $table->integer('sender_id')->index();
            $table->integer('receiver_id')->index();
            $table->tinyInteger('read')->default(0);
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
        Schema::dropIfExists('discussion_messages');
    }
}
