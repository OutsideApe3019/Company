<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use User;
use Ticket;
use Alert;
use TicketMsg;
use News;

class AdminController extends Controller
{
    public function restoreUser($id)
    {
        User::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success', 'User restored.');
    }

    public function deleteUser($id)
    {
        User::find($id)->delete();
        return redirect()->back()->with('success', 'User deleted.');
    }

    public function forceDeleteUser($id)
    {
        User::withTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success', 'User deleted.');
    }

    public function editUser(Request $request, $id)
    {
        $user = User::find($id);

        $validated = $request->validate([
            'firstName' => ['string', 'max:255'],
            'lastName' => ['string', 'max:255'],
            'username' => ['string', 'max:255', 'unique:users'],
            'email' => ['string', 'max:255', 'email', 'unique:users'],
            'isAdmin' => ['numeric'],
        ]);

        if($request->input('firstName') !== null) {
            $user->firstName = $request->input('firstName');
        }

        if($request->input('lastName') !== null) {
            $user->lastName = $request->input('lastName');
        }

        if($request->input('username') !== null) {
            $user->username = $request->input('username');
        }

        if($request->input('email') !== null) {
            $user->email = $request->input('email');
        }

        if($request->input('isAdmin') !== null) {
            $user->isAdmin = $request->input('isAdmin');
        }

        $user->save();
        return redirect()->route('panel.users')->with('success', 'User edited successfully.');
    }

    public function banUser($id) {
        $user = User::find($id);

        if($user == null) {
            return view('panel.null', ['page' => 'User not found', 'title' => 'Ban user', 'body' => 'User not found.']);
        }

        $user->isBanned = true;

        $user->save();
        return redirect()->route('panel.users')->with('success', 'User banned successfully.');
    }

    public function unbanUser($id) {
        $user = User::find($id);

        if($user == null) {
            return view('panel.null', ['page' => 'User not found', 'title' => 'Unban user', 'body' => 'User not found.']);
        }

        $user->isBanned = false;

        $user->save();
        return redirect()->route('panel.users')->with('success', 'User unbanned successfully.');
    }

    public function editTicket(Request $request, $id) {
        $ticket = Ticket::find($id);

        if($ticket->status == 'closed') {
            return abort(403);
        }

        $validation = $request->validate([
            'text' => ['required', 'max:500'],
        ]);

        $data = [
            'senderId' => '0',
            'text' => $request->input('text'),
            'ticketId' => $id,
        ];

        TicketMsg::create($data);
        return redirect()->back();
    }

    public function closeTicket($id) {
        $ticket = Ticket::find($id);

        if($ticket->status == 'closed') {
            return abort(403);
        }

        $ticket->status = 'closed';
        $ticket->save();
        return redirect()->back()->with('success', 'Ticket closed successfully.');;
    }

    public function createAlert(Request $request) {
        $validated = $request->validate([
            'reciver' => ['required', 'string', 'exists:users,username'],
            'title' => ['required', 'string', 'max:100'],
            'text' => ['required', 'string', 'max:500'],
        ]);

        $user = User::where('username', $request->input('reciver'))->first();

        $data = [
            'userId' => $user->id,
            'title' => $request->input('title'), 
            'text' => $request->input('text'),
        ];

        Alert::create($data);

        return redirect()->route('panel.alerts')->with('success', 'Alert created successfully.');
    }

    public function createNew(Request $request) {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'text' => ['required', 'string', 'max:10000'],
        ]);

        $data = [
            'title' => $request->input('title'), 
            'text' => $request->input('text'),
        ];

        News::create($data);

        return redirect()->route('panel.news')->with('success', 'New created successfully.');
    } 
}
