<?php

namespace App\Http\Controllers\RegularUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Send email to the given address
        Mail::to('stephenloishorua88@gmail.com')->send(new ContactMessage($validated));

        // Redirect back with success message
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
