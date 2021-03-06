<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'log';
    protected $guarded = ['id'];

    public function object()
    {
        return $this->belongsTo('App\Object');
    }
}
