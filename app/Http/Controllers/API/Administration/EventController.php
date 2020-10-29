<?php

namespace App\Http\Controllers\API\Administration;

use App\Models\Event;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Http\Requests\Events\ManageRequest;
use App\Member;
use App\Participant;
use App\Prize;
use App\Ticket;
use App\Winner;

class EventController extends Controller
{
    public function __construct()
	{
		// $this->middleware('auth.permission');
    }

    public function getParticipants(Request $request) {
        $items = null;

        if (strtolower($request->query('branch')) != 'all') {
            $items = DB::table('participants')
            ->select('tickets.id','participants.id as participant_id',
            'full_name','members.branch','members.address','tickets.ticket_no',
                'participants.major_winner','participants.consolation_winner')    
            ->where(function($query) use ($request) {
            $query->whereRaw("participants.event_id = ? AND 
                            participants.id 
                            NOT IN (SELECT participant_id FROM winners WHERE prize_type = ? 
                            AND event_id = ?) AND 
                            members.branch = ? AND
                            tickets.deleted_at IS NULL", 
                            [
                                $request->query('event_id'), 
                                $request->query('prize_type'), 
                                $request->query('event_id'), 
                                $request->query('branch')
                            ]);
            })
            ->orderBy('tickets.id','asc')
            ->join('members','participants.member_id','members.id')
            ->join('tickets','participants.id','tickets.participant_id');
        } else {
            $items = DB::table('participants')
            ->select('tickets.id','participants.id as participant_id',
            'full_name','members.branch','tickets.ticket_no',
                'participants.major_winner','participants.consolation_winner')    
            ->where(function($query) use ($request) {
            $query->whereRaw("participants.event_id = ? AND 
                            participants.id 
                            NOT IN (SELECT participant_id FROM winners WHERE prize_type = ? 
                            AND event_id = ?) AND
                            tickets.deleted_at IS NULL", 
                            [
                                $request->query('event_id'), 
                                $request->query('prize_type'), 
                                $request->query('event_id')
                            ]);
            })
            ->orderBy('tickets.id','asc')
            ->join('members','participants.member_id','members.id')
            ->join('tickets','participants.id','tickets.participant_id');
        }         
        return response()->json($items->get());
    }

    public function saveWinner(Request $request)
    {
        
        $selectedPrize = Prize::find($request->prize_id);
        $selectedPrize->claimed_count +=1;
        
        $selectedPrize->save();
        
        $participant = Participant::find($request->participant_id);
        if (strtolower($selectedPrize->prize_type) == 'consolation prize') {
            $participant->consolation_winner = 1;
        } else {
            $participant->major_winner = 1;
        }

        $participant->save();

        $member = Member::find($participant->member_id);
        
        
        $winner = new Winner();
        $winner->ticket_no = $request->ticket_no;
        $winner->event_id = $request->event_id;
        $winner->participant_id = $participant->id;
        $winner->member_id = $participant->member_id;
        $winner->prize = $selectedPrize->particulars;
        $winner->participant_name = $request->participant_name;
        $winner->address = $member->address;
        $winner->branch = $request->branch;
        $winner->prize_type = $selectedPrize->prize_type;
        $winner->save();
    }
    
    public function index(Request $request)
    {
        $request->merge(['order' => ['created_at' => 'desc']]);

		$class = new Event;

		return $class->traversify();
    }


    public function store(ManageRequest $request)
	{
        $event = Event::_store($request);

        // $event->_generateQrCode();

        return response(['path' => env('APP_URL') . '/events/' . $event->slug], 200);
    }

    public function show(Request $request, $id)
	{
		$event = Event::findOrDie($id);

		return $event;
    }
    
    public function edit(Request $request, $id)
	{
		$event = Event::findOrDie($id);

		return $event->toArrayEdit();
	}
    
    public function update(ManageRequest $request, $id)
    {
        $event = Event::findOrDie($id);

        $event->update(Event::_update($request));

        $updated = Event::find($id);

        $updated->_generateQrCode();

        return response(['path' => env('APP_URL') . '/events/' . $updated->slug], 200);
    }

    public function changeActive(Request $request, $id)
    {
        $event = Event::findOrDie($id);

        $event->update(['is_active' => ($event->is_active ? 0 : 1)]);

        return $event;
    }

    public function destroy(Request $request, $id)
    {
        $event = Event::findOrDie($id);

        $event->players()->delete();

        $event->delete();

        return response(['message' => 'Event has been deleted!'], 200);
    }
}
