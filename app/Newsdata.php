<?php

namespace BreakingNEWSTab;

use Illuminate\Database\Eloquent\Model;

class Newsdata extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    //public $timestamps = false;

    protected $table = 'newsdata';
    
   public function rssfeednews() {
       return $this->belongsTo('BreakingNEWSTab\Rssfeedlinks', 'rss_feed_id');
   }
}
