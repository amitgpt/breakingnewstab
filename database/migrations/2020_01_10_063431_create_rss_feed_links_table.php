<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRssFeedLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rss_feed_links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('rsslinks');
            $table->integer('categories_id')->unsigned();
            $table->integer('channels_id')->unsigned();
            $table->tinyInteger('status')->default('1')->comment('1=>Active,0=>Deactive');
            $table->tinyInteger('is_featured')->default('0')->comment('0=>Not Featured,1=>Featured');
            $table->timestamps();
        });
        
        Schema::table('rss_feed_links', function($table) {
            $table->foreign('categories_id')->references('id')->on('categories');
            $table->foreign('channels_id')->references('id')->on('channels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rss_feed_links');
    }
}
