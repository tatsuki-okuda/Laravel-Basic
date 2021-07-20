<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('contact');
    }

    /**
     * Admin Contact
     *
     * @return void
     */
    public function AdminContact()
    {
        $contacts = Contact::latest()->paginate(5);
        return view('admin.contact.index', compact('contacts'));
    }


    /**
     * Admin Add Contact
     *
     * @return void
     */
    public function AdminAddContact()
    {
        return view('admin.contact.create');
    }


    public function AdminStoreContact(Request $request)
    {
        Contact::insert([
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'created_at' => Carbon::now()
       ]);

       return Redirect()
           ->route('admin.contact')
           ->with('success', 'Contact Inserted Succesfully');
    }
}
