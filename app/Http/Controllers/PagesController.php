<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use User;
use Ticket;
use TicketMsg;
use Alert;
use News;
use NewsComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class PagesController extends Controller
{
    public function home() {
        $news = News::orderBy('id', 'desc')->paginate(5);

        return view('home', ['page' => 'Home', 'news' => $news]);
    }

    public function terms() {
        return view('terms', ['page' => 'Terms and Conditions']);
    }

    public function settings() {
        return view('settings', ['page' => 'Settings']);
    }

    public function support() {
        $tickets = Ticket::where('senderId', '=', Auth::user()->id)->get();

        return view('support', ['page' => 'Support', 'tickets' => $tickets]);
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
        $totalUsers = User::count();
        $totalTickets = Ticket::where('status', 'open')->count();
        $totalAlerts = Alert::count();
        $totalNews = News::count();

        return view('panel.index', ['page' => 'Panel', 'totalUsers' => $totalUsers, 'totalTickets' => $totalTickets, 'totalAlerts' => $totalAlerts, 'totalNews' => $totalNews]);
    }

    public function usersPanel() {
        $users = User::withTrashed()->paginate(15);
        $totalUsers = User::all()->count();
        $totalLastUsers = User::where('created_at', '>', Carbon::now()->subDays(7))->count();
        $totalBannedUsers = User::withTrashed()->where('isBanned', true)->count();
        $totalDeletedUsers = User::withTrashed()->whereNot('deleted_at', null)->count();
        $totalAdmins = User::withTrashed()->where('isAdmin', true)->count();

        return view('panel.users', ['page' => 'Panel / Users', 'users' => $users, 'totalUsers' => $totalUsers, 'totalLastUsers' => $totalLastUsers, 'totalBannedUsers' => $totalBannedUsers, 'totalDeletedUsers' => $totalDeletedUsers, 'totalAdmins' => $totalAdmins]);
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
            return view('panel.edit', ['page' => 'Edit user', 'id' => $id, 'user' => $user]);
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

        return view('tickets.see', ['ticket' => $ticket, 'ticketMsgs' => $ticketMsgs, 'page' => 'Ticket / ' . $id]);
    }

    public function ticketCreate() {
        return view('tickets.create', ['page' => 'New ticket']);
    }

    public function panelTickets() {
        $tickets = Ticket::where('status', '=', 'open')->paginate(15);
        $totalTickets = Ticket::where('status', 'open')->count();
        $totalClosedTickets = Ticket::where('status', 'closed')->count();

        return view('panel.tickets.index', ['page' => 'Panel / Tickets', 'tickets' => $tickets, 'totalTickets' => $totalTickets, 'totalClosedTickets' => $totalClosedTickets]);
    }

    public function panelTicketSee($id) {
        $ticket = Ticket::find($id);

        if($ticket == null) {
            return abort(404);
        }

        $ticketMsgs = TicketMsg::where('ticketId', '=', $ticket->id)->get();

        return view('panel.tickets.view', ['ticket' => $ticket, 'ticketMsgs' => $ticketMsgs, 'page' => 'Panel / Tickets / '. $ticket->id]);
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

    public function alerts() {
        $alerts = Alert::where('userId', Auth::user()->id)->get();;

        if($alerts->count() == 0) {
            $alerts = null;
        }

        return view('alerts', ['page' => 'Alerts', 'alerts' => $alerts]);
    }

    public function alertShow($id) {
        $alert = Alert::find($id);

        if($alert == null) {
            return abort(404);
        }

        if(Auth::user()->id !== $alert->userId) {
            return abort(403);
        }

        if($alert->read == false) {
            $alert->read = true;
            $alert->save();
        }

        return view('alerts.show', ['alert' => $alert, 'page' => 'Alerts / '. $alert->title]);
    }

    public function panelAlerts() {
        $alerts = Alert::paginate(15);
        
        $totalAlerts = Alert::count();
        $totalReadAlerts = Alert::where('read', true)->count();
        $totalNotReadAlerts = Alert::where('read', false)->count();

        return view('panel.alerts.index', ['page' => 'Panel / Alerts', 'alerts' => $alerts, 'totalAlerts' => $totalAlerts, 'totalReadAlerts' => $totalReadAlerts, 'totalNotReadAlerts' => $totalNotReadAlerts]);
    }

    public function panelAlertShow($id) {
        $alert = Alert::find($id);

        if($alert == null) {
            return abort(404);
        }

        return view('panel.alerts.show', ['alert' => $alert, 'page' => 'Panel / Alerts / '. $alert->title]);
    }

    public function panelAlertCreate() {
        return view('panel.alerts.create', ['page' => 'New alert']);
    }

    public function panelSettingsGeneral() {
        return view('panel.settings.general', ['page' => 'General settings']);
    }

    public function showNew($id) {
        $new = News::where('id', $id)->first();

        if($new == null) {
            return abort(404);
        }

        $comments = NewsComment::where('newId', $new->id)->get();

        return view('news.show', ['page' => $new->title, 'new' => $new, 'comments' => $comments]);
    }

    public function panelNews() {
        $totalNews = News::count();
        $news = News::paginate(15);

        return view('panel.news.index', ['page' => 'News', 'news' => $news, 'totalNews' => $totalNews]);
    }

    public function panelNewsCreate() {
        return view('panel.news.create', ['page' => 'New new']);
    }
}
