<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    protected $guarded = ['id'];

    protected $appends = ['remaining'];

    public function event()
    {
        return $this->belongsTo('App\Models\Event');
    }

    public function getRemainingAttribute()
    {
        return (int) $this->quantity - (int) $this->claimed_count;
    }
}
