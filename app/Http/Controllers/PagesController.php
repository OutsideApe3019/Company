<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ticket;
use App\Models\TicketMsg;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function terms() {
        return view('terms', ['page' => 'Terms and Conditions']);
    }

    public function settings() {
        return view('settings', ['page' => 'Settings']);
    }

    public function support() {
        return view('support', ['page' => 'Support']);
    }

    public function editFirstName() {
        return view('settings.firstName', ['page' => 'Edit first name']);
    }

    public function editLastName() {
        return view('settings.lastName', ['page' => 'Edit last name']);
    }

    public function editUsername() {
        return view('settings.username', ['page' => 'Edit username']);
    }

    public function editEmail() {
        return view('settings.email', ['page' => 'Edit email']);
    }

    public function editPassword() {
        return view('settings.password', ['page' => 'Edit password']);
    }

    public function panel() {
        return view('panel.index', ['page' => 'Panel']);
    }

    public function usersPanel() {
        return view('panel.users', ['page' => 'Panel / Users']);
    }

    public function contact() {
        return view('contact', ['page' => 'Contact us']);
    }

    public function cookies() {
        return view('cookies', ['page' => 'Cookies']);
    }

    public function editUser($id) {
        $user = User::find($id);
        if($user == null) {
            return view('panel.null', ['page' => 'User not found', 'title' => 'Edit user', 'body' => 'User not found.']);
        } else {
            return view('panel.edit', ['page' => 'Edit user', 'id' => $id]);
        }
    }

    public function ticketSee($id) {
        $ticket = Ticket::find($id);

        if($ticket == null) {
            return view('tickets.null', ['page' => 'Ticket not found', 'title' => 'Ticket not found.', 'body' => 'Ticket not found.']);
        }

        $ticketMsgs = TicketMsg::where('ticketId', '=', $ticket->id)->get();

        if(Auth::user()->id !== $ticket->senderId) {
            return abort(403);
        }

        return view('tickets.see', ['ticket' => $ticket, 'ticketMsgs' => $ticketMsgs, 'page' => 'Ticket - ' . $id]);
    }

    public function ticketCreate() {
        return view('tickets.create', ['page' => 'New ticket']);
    }

    public function panelTickets() {
        $tickets = Ticket::where('status', '=', 'open')->paginate(15);
        return view('panel.tickets.index', ['page' => 'Panel / Tickets', 'tickets' => $tickets]);
    }

    public function panelTicketSee($id) {
        $ticket = Ticket::find($id);

        if($ticket == null) {
            return abort(404);
        }

        $ticketMsgs = TicketMsg::where('ticketId', '=', $ticket->id)->get();

        return view('panel.tickets.view', ['ticket' => $ticket, 'ticketMsgs' => $ticketMsgs, 'page' => 'Panel / Tickets - '. $ticket->id]);
    }

    public function user($username) {
        $user = User::where('username', '=', $username)->first();

        if($user == null) {
            return abort(404);
        }

        return view('users.index', ['page' => 'User / ' . $username, 'user' => $user]);
    }

    public function editDelete() {
        return view('settings.delete', ['page' => 'Delete account']);
    }
}
