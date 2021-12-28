<?php

namespace BreakingNEWSTab;

use Illuminate\Database\Eloquent\Model;

class Channels extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $timestamps = false;
    protected $table = 'channels';
}
