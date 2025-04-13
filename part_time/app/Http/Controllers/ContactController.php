<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{   


    public function create()
    {
        return view('pages.contact');
    }


    public function store(Request $request)
    {
            $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);
    
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        
    
        return redirect()->route('contactCreate')->with('success', 'Your message has been sent successfully!');
    }

    //----------------- for admin page --------------------------------------

    public function index()
    {
        $contacts = Contact::latest()->paginate(10); 
        return view('admin.contacts.index', compact('contacts'));
    }

    
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Contact message deleted successfully.');
    }
    
}     