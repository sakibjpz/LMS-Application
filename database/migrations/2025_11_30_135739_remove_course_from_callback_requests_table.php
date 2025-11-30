<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('callback_requests', function (Blueprint $table) {
        $table->dropColumn('course'); // remove old field
    });
}

public function down()
{
    Schema::table('callback_requests', function (Blueprint $table) {
        $table->string('course'); // restore if needed
    });
}
};
