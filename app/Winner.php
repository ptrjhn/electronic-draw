<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    public function event()
    {
        return $this->belongsTo('App\Winner');
    }
}
