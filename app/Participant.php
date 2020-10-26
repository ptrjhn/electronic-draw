<?php

namespace App;

use App\Models\Traits\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function event()
    {
        return $this->belongsTo(\App\Models\Event::class);
    }

    public function tickets()
    {
        return $this->hasMany(\App\Ticket::class);
    }

    
}

