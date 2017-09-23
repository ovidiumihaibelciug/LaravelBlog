<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //

    public function contact() {
        return view('pages.contact');
    }

    public function contactCreate(Request $request) {

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'message' => 'required|string|'
        ]);

        Contact::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' =>$request->input('message')
        ]);

        return back()->with('success','Your message was sent! Thank you for your oppinion.');
    }
}
