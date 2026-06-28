<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDancersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dancers', function (Blueprint $table) {
            $table->id();
            $table->integer('subscription_id')->default(0);
            $table->string('name');
            $table->string('birth');
            $table->string('phone');
            $table->string('viber_phone')->nullable();
            $table->string('image');
            $table->string('parent_name');
            $table->string('comment');
            $table->integer('class_count')->nullable();
            $table->integer('balance')->nullable();
            $table->string('viber_id')->nullable();
            $table->string('whatsup_id')->nullable();
            $table->string('telegram_id')->nullable();
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
        Schema::dropIfExists('dancers');
    }
}
