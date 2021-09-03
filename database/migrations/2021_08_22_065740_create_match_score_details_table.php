<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchScoreDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_score_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matchdetail_id')
                  ->constrained('match_details')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->integer('team');
            $table->string('name');
            $table->string('time');
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
        Schema::dropIfExists('match_score_details');
    }
}
