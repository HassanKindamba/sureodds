<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    // Kuonyesha page ya contact
    public function contact()
    {
        return view('frontend.contact');
    }

    // Kupokea form kutoka frontend
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'contact' => 'required',
        'reason' => 'nullable',
        'message' => 'nullable',
    ]);

    Contact::create([
        'name' => $request->name,
        'contact' => $request->contact,
        'reason' => $request->reason,
        'message' => $request->message,
    ]);

    return redirect()->back()->with('success', '✅ Ujumbe umetumwa vizuri');
}
}