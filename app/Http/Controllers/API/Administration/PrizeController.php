<?php

namespace App\Http\Controllers\API\Administration;

use App\Prize;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class PrizeController extends Controller
{
  public function index(Request $request)
    {
        $prizes = Prize::orderBy('id', 'desc')->get();

        if ($request->query('event_id')) {
            $prizes = Prize::where('event_id','=', $request->query('event_id'))->orderBy('id', 'desc')->get();
        }

        return response()->json($prizes);
    }

    public function show($id) {
      $prize = Prize::findOrFail($id);
      return response()->json($prize);
    } 

    public function store(Request $request)
    {
        $this->validate($request,[
          'particulars' => ['required', 
            Rule::unique('prizes')->where(function($query) use ($request) {
              $query->where([
                ['particulars', $request->particulars],
                ['branch', $request->branch],
                ['prize_type', $request->prize_type],
                ['event_id', $request->event_id],
              ]);
            })],
          'quantity' => 'required',
          'branch' => 'required',
          'prize_type' => 'required',
          'event_id' => 'required',
        ]);
        
        $newPrize =  new Prize;

        $newPrize->particulars = $request->particulars;
        $newPrize->quantity = $request->quantity;
        $newPrize->prize_type = $request->prize_type;
        $newPrize->event_id = $request->event_id;
        $newPrize->branch = $request->branch;
        $newPrize->claimed_count = 0;

        $newPrize->slug = Str::slug($request->particulars . '-' .$request->branch . '-branch');
      
        $newPrize->save();
        return response()->json($newPrize);
    }


    public function update(Request $request, $id)
    {
      $this->validate($request,[
          'particulars' => ['required', 
            Rule::unique('prizes')->where(function($query) use ($request) {
              $query->where([
                ['particulars', $request->particulars],
                ['branch', $request->branch],
                ['prize_type', $request->prize_type],
                ['event_id', $request->event_id],
                ['id', '!=', $request->id]
              ]);
            })],
          'quantity' => 'required',
          'prize_type' => 'required',
          'event_id' => 'required',
          'branch' => 'required'
        ]);
        
        
      $editPrize = Prize::find($id);
      
      $editPrize->particulars = $request->particulars;
      $editPrize->quantity = $request->quantity;
      $editPrize->prize_type = $request->prize_type;
      $editPrize->event_id = $request->event_id;
      $editPrize->branch = $request->branch;
      $editPrize->claimed_count = 0;

      $editPrize->slug = Str::slug($request->particulars . '-' .$request->branch . '-branch');
            
      $editPrize->save();

      return response()->json($editPrize);
    }


    public function destroy($id)
    {
        Prize::find($id)->delete();
        return response()->json(['done']);
    }

}
