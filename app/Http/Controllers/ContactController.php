<?php

namespace App\Http\Controllers;

use App\Notifications\SendContactForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{

    public function index(){
        return view('clients.contact');
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

       Notification::route('mail', 'sergioaj815@gmail.com')->notify(new SendContactForm($data));

        return back()->with('success', 'Mensaje enviado correctamente.');
    }
}
