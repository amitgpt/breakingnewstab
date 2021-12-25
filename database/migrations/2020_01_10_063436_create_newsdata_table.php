<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsdataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsdata', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('link');
            $table->text('is_permalink'); //guid
            $table->longText('description');
            $table->string('creator');
            $table->string('pubdate');
            $table->date('publishdate');
            $table->longText('imageurl');
            $table->text('source_url');
            $table->bigInteger('rss_feed_id')->unsigned();
            $table->timestamps();
        });
        
        Schema::table('newsdata', function($table) {
            $table->foreign('rss_feed_id')->references('id')->on('rss_feed_links');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('newsdata');
    }
}
