<?php

namespace BreakingNEWSTab;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $timestamps = false;
    protected $table = 'categories';

    public function rssfeednews() {
        return $this->hasMany('BreakingNEWSTab\Rssfeedlinks', 'categories_id');
    }
}
