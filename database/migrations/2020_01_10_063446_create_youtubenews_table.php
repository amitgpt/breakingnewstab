<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYoutubenewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('youtubenews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('link');
            $table->string('creator');
            $table->string('pubdate');
            $table->date('publishdate');
            $table->text('source_url');
            $table->string('ytub_channel_id');
            $table->string('yt_video_id');
            $table->longText('imageurl');
            $table->timestamps();            
        });
        
        // Full Text Index ALTER TABLE youtubenews ADD FULLTEXT (title)
        DB::statement('ALTER TABLE youtubenews ENGINE = MyISAM');
        DB::statement('ALTER TABLE youtubenews ADD FULLTEXT (title)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('youtubenews');
    }
}
