<?php

namespace App\Models;

use App\Models\Model;
use App\Models\Traits\Traversify;
use App\Models\Traits\FileStorage;
use App\Prize;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    use Traversify, FileStorage;

    protected $guarded = [];

    public static $searchables = ['name', 'prize'];
    public static $filterables = ['is_active'];
    public static $orderables = ['created_at'];

    public static function _store($data)
    {
        $class = new self;
        $class->slug = slugifyEvent($data['name']);
        $class->name = $data['name'];
        $class->prize = $data['prize'];
        $class->location = $data['location'];
        $class->event_date = $data['event_date'];
        $class->is_active = 1;
        $class->created_by = 1;
        $class->save();

        return $class;
    }

    public static function _update($data)
    {
        return [
            'slug' => slugifyEvent($data['name']),
            'name' => $data['name'],
            'prize' => $data['prize'],
            'location' => $data['location'],
            'event_date' => $data['event_date'],
            'updated_by' => 1
        ];
    }

   

    public function players()
    {
        return $this->hasMany('App\Models\Player');
    }


    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    public function prizes()
    {
        return $this->hasMany('App\Prize');
    }

    public function participants()
    {
        return $this->hasMany('App\Participant');
    }


    public function winners()
    {
        return $this->hasMany('App\Winner');
    }

    public function toArray()
    {
        $arr = [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
            'prize' => $this->prize,
            'location' => $this->location,
            'event_date' => (new \DateTime($this->event_date))->format('F d, Y'),
            'is_active' => $this->is_active,
            'path' => env('APP_URL') . '/storage/' . $this->path,
            'winners' => $this->winners(),
            'prizes' => $this->prizes()
        ];

        if (request()->has('include-players')) $arr['players'] = $this->players;

        return $arr;
    }

    public function toArrayEdit()
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
            'prize' => $this->prize,
            'location' => $this->location,
            'event_date' => $this->event_date
        ];
    }
}
