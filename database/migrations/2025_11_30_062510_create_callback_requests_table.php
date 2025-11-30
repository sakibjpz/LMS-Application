<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('callback_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('course');
            $table->string('date');
            $table->string('time');
            $table->tinyInteger('status')->default(0); // 0 = pending, 1 = done
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('callback_requests');
    }
};
