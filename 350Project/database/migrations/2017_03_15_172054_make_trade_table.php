<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeTradeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trade', function (Blueprint $table) {
           $table->string('Year', 50);
           $table->string('Reporter', 50);
           $table->string('Partner', 50);
           $table->string('Commodity',100);
           $table->biginteger('Import');
           $table->string('Conternt',50);
           $table->biginteger('Export');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trade');
    }
}
