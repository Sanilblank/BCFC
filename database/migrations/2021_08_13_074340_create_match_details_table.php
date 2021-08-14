<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team1_id')
                  ->constrained('teams')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('team2_id')
                  ->constrained('teams')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('matchtype_id')
                  ->constrained('match_types')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->dateTime('datetime');
            $table->foreignId('stadium_id')
                  ->constrained('match_stadia')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->boolean('completed')->default(0);
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
        Schema::dropIfExists('match_details');
    }
}
