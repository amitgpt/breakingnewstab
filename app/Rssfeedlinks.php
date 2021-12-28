<?php

namespace BreakingNEWSTab;

use Illuminate\Database\Eloquent\Model;

class Rssfeedlinks extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'categories_id', 'channels_id', 'rsslinks','status','is_featured'
    ];
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    //public $timestamps = false;
    protected $table = 'rss_feed_links';

    public function newsdata() {
        return $this->hasMany('BreakingNEWSTab\Newsdata', 'rss_feed_id');
    }

    public function categories() {
        return $this->belongsTo('BreakingNEWSTab\Categories', 'categories_id');
    }

}
