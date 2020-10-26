<?php

namespace App\Http\Controllers\API\Administration;

use App\Http\Controllers\Controller;
use App\Participant;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ParticipantController extends Controller
{
  public function index(Request $request)
  {

    $items = DB::table('tickets')
      ->select('tickets.id', 'full_name', 'branch', 'tickets.ticket_no')
      ->where(function ($query) use ($request) {
        $query->whereRaw("tickets.event_id = ? AND
          (tickets.ticket_no like ? OR full_name like ?) AND tickets.deleted_at IS NULL",
          [$request->query('event_id'), '%' . $request->query('search') . '%', '%' . $request->query('search') . '%']);
      })
      ->orderBy('tickets.id', 'desc')
      ->join('members', 'members.id', 'tickets.member_id')
      ->join('participants', 'participants.event_id', 'tickets.event_id')
      ->groupBy("full_name", "members.branch", "ticket_no", "tickets.event_id", "tickets.id")
      ->paginate(20);

    return response()->json($items);
  }

  public function getRaffleParticipants(Request $request)
  {

    $items = DB::table('tickets')
      ->select('tickets.id', 'full_name', 'branch', 'tickes.ticket_no',
        'participants.major_winner', 'participants.consolation_winner')
      ->orderBy('tickets.id', 'desc')
      ->join('members', 'members.id', 'tickets.member_id')
      ->join('participants', 'participants.event_id', 'tickets.event_id')
      ->groupBy("full_name", "branch", "ticket_no", "major_winner", "consolation_winner")
      ->paginate(20);

    return response()->json($items);

  }

  public function store(Request $request)
  {
    $message = ['member_id.unique' => 'participant name already exist'];

    $this->validate($request, [
      'event_id' => 'required',
      'member_id' => ['required', Rule::unique('tickets')->where(function ($query) use ($request) {
        $query->where([
          ['member_id', '=', $request->member_id],
          ['event_id', '=', $request->event_id],
          ['deleted_at', '=', NULL]
        ]);
      })],
    ], $message);

    $participant = Participant::create($request->all());
    $tickets = array();

    for ($i = 1; $i <= $request->ticket_count; $i++) {
      $lastTicket = DB::table('tickets')
        ->where('event_id', '=', $request->event_id)
        ->orderBy('id', 'DESC')->first();

      $ticketId = $lastTicket == null ? 1 : (int) $lastTicket->ticket_no + 1;
      $ticket = new Ticket();
      $ticket->ticket_no = sprintf('%05d' . PHP_EOL, $ticketId);
      $ticket->member_id = $participant->member_id;
      $ticket->event_id = $participant->event_id;
      $ticket->participant_id = $participant->id;

      $ticket->saveOrFail();
      array_push($tickets, $ticket);
    }

    return response()->json([
      'particpants' => $participant,
      'tickets' => $tickets,
    ]);
  }

  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'full_name' => 'required',
      'branch' => 'required',
    ]);
    $edit = Participant::find($id)->update($request->all());
    return response()->json($edit);
  }

  public function destroy($id)
  {
    Ticket::find($id)->delete();

    return response()->json(['done']);
  }

}
