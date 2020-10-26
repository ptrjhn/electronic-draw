<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::paginate(20);
        return view('administration.members.index')->with(['members' => $members, 'title' => 'Members']);
    }
}
