<?php

namespace App\Http\Controllers\API\Administration;

use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $items = Member::orderBy('id', 'desc')->paginate(15);

        if ($request->query('search')) {
            $items = Member::where('full_name','like', '%' . $request->query('search') . '%')->orderBy('id', 'desc')->paginate(20);
        }
        
        return response()->json($items);
    }

     public function search(Request $request)
    {
        if (trim($request->query('search')) != '') {
            $items = Member::where('full_name','like', '%' . $request->query('search') . '%')->orderBy('full_name', 'asc')->paginate(5);
        }
        
        return response()->json($items);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
          'full_name' => ['required', 
          Rule::unique('members')->where(function($query) use ($request) {
                $query->where('full_name', $request->full_name);
          })],
          'branch' => 'required',
        ]);        

        $create = Member::create($request->all());
        return response()->json($create);
    }


    public function update(Request $request, $id)
    {
      $this->validate($request,[
          'full_name' =>[
              'required',
              Rule::unique('members')->where(function($query) use ($request) {
                $query->where([
                    ['full_name', $request->full_name],
                    ['id', '!=', $request->id],
                ]);
          })],
          'branch' => 'required',
        ]);
      $edit = Member::find($id)->update($request->all());
      return response()->json($edit);
    }


    public function destroy($id)
    {
        Member::find($id)->delete();
        return response()->json(['done']);
    }


}
