<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->json('tag')->nullable();
            $table->string('date')->nullable();
            $table->longText('smalldesc')->nullable();
            $table->longText('details')->nullable();
            $table->integer('view_count')->default(0);
            $table->string('authorname')->nullable();
            $table->string('authorimage')->nullable();
            $table->boolean('status');
            $table->integer('draft')->default(0);
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
        Schema::dropIfExists('blogs');
    }
}
