<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email','password','username','first_name','last_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public static function _store($data)
	{
        $class = new self;
		$class->username = $data['username'];
		$class->first_name = $data['first_name'];
		$class->last_name = $data['last_name'];
		$class->password = bcrypt('Abcd1234');
		$class->is_enabled = 1;
		$class->created_by = Auth::user()->username;
        $class->save();

        return $class;
	}

	public static function _update($data)
	{
    $class = new self;
		$class->username = $data['username'];
		$class->first_name = $data['first_name'];
		$class->last_name = $data['last_name'];
		$class->password = bcrypt('Abcd1234');
		$class->is_enabled = 1;
	
	}

    public function userProfile()
	{
		return $this->hasOne('App\Models\UserProfile');
	}

    public function toArray()
	{
		$arr = ['id' => $this->id,
				 'username' => $this->username,
				 'first_name' => $this->first_name,
				 'last_name' => $this->last_name,
				 'is_enabled' => $this->is_enabled,
				];

		return $arr;
    }
    
    public function toArrayEdit()
	{
		$arr =  ['id' => $this->id,
				 'username' => $this->username,
				 'first_name' => $this->first_name,
				 'last_name' => $this->last_name
				];

		return $arr;
	}
}
