<?php

namespace App\Http\Controllers\API\Administration;

use App\Models\User;
use App\Models\UserProfile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Users\ManageRequest;

class UserController extends Controller
{
    public function __construct()
	{
		// $this->middleware('auth.permission');
    }

    public function index()
    {

        $users = User::latest()->get();
        return $users;

    }

    public function store(Request $request)
	{
        $class = new User();
		$class->username = $request['username'];
		$class->first_name = $request['first_name'];
		$class->last_name = $request['last_name'];
		$class->email = "providerscoop@gmail.com";
        $class->password = bcrypt('Abcd1234');
        $class->user_type = 'standard_user';
		$class->is_enabled = 1;
		$class->created_by = Auth::user()->id;
        $class->save();
        
        return $class;

    }

    public function edit(Request $request, $id)
	{
        $user = User::find($id);
        
        if(!$user) return abort('Resources not found');

		return $user->toArrayEdit();
    }
    
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if(!$user) return abort('Resources not found');

		$user->password = bcrypt($request->password);
		$user->save();
        return $user;
    }
}
