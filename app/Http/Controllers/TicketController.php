<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketMsg;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function edit(Request $request, $id)
    {
        $ticket = Ticket::find($id);

        if ($ticket->status == 'closed') {
            return abort(403);
        }

        if ($ticket->senderId !== Auth::user()->id) {
            abort(403);
        }

        $validation = $request->validate([
            'text' => ['required', 'max:500'],
        ]);

        $data = [
            'senderId' => Auth::user()->id,
            'text' => $request->input('text'),
            'ticketId' => $id,
        ];

        TicketMsg::create($data);
        return redirect()->back();
    }

    public function create(Request $request)
    {
        $validation = $request->validate([
            'reason' => ['required', 'max:50'],
            'text' => ['required', 'max:500'],
        ]);

        $data = [
            'reason' => $request->input('reason'),
            'senderId' => Auth::user()->id,
        ];

        $ticket = Ticket::create($data);

        $data = [
            'senderId' => Auth::user()->id,
            'text' => $request->input('text'),
            'ticketId' => $ticket->id,
        ];

        TicketMsg::create($data);

        return redirect()->route('ticket.see', ['id' => $ticket->id]);
    }

    public function close($id)
    {
        $ticket = Ticket::find($id);

        if ($ticket->senderId !== Auth::user()->id) {
            abort(403);
        }

        if ($ticket->status == 'closed') {
            return abort(403);
        }

        $ticket->status = 'closed';
        $ticket->save();

        return redirect()->back()->with('success', 'Ticket closed successfully.');
    }

    public function delete($id)
    {
        $ticket = Ticket::find($id);
        $ticketMsgs = TicketMsg::where('ticketId', '=', $id)->get();

        if ($ticket == null) {
            abort(404);
        }

        if ($ticket->senderId !== Auth::user()->id) {
            abort(403);
        }

        if ($ticket->status !== 'closed') {
            return abort(403);
        }

        foreach ($ticketMsgs as $ticketMsg) {
            $ticketMsg->delete();
        }

        $ticket->delete();
        return redirect()->back()->with('success', 'Ticket deleted successfully.');
    }
}
