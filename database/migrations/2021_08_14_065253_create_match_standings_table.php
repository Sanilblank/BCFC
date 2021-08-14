<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchStandingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_standings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matchtype_id')
                  ->constrained('match_types')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('team_id')
                  ->constrained('teams')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->integer('played');
            $table->integer('win');
            $table->integer('draw');
            $table->integer('loss');
            $table->integer('goalsscored');
            $table->integer('goalsagainst');
            $table->integer('goaldifferential');
            $table->integer('points');
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
        Schema::dropIfExists('match_standings');
    }
}
