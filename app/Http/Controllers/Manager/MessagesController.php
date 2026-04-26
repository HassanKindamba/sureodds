<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class MessagesController extends Controller
{
    // Kuonyesha messages zote
    public function index()
    {
        $messages = Contact::latest()->get();
        return view('admin.manager.messages.index', compact('messages'));
    }

    // Kuonyesha message moja
    public function show($id)
    {
        $message = Contact::findOrFail($id);
        return view('admin.manager.messages.show', compact('message'));
    }

    // Kufuta message
    public function destroy($id)
    {
        $message = Contact::findOrFail($id);
        $message->delete();

        return redirect()->back()->with('success', 'Message imefutwa');
    }
}