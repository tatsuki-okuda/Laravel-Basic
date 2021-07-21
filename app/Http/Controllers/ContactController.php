<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactForm;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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


    /**
     * Admin Store Contact
     *
     * @param Request $request
     * @return void
     */
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



    /**
     * Contact
     *
     * @return void
     */
    public function Contact()
    {
        $contact = DB::table('contacts')->first();
        return view('pages.contact', compact('contact'));
    }



    /**
     *  User Contact Form
     *
     * @param Request $request
     * @return void
     */
    public function ContactForm(Request $request)
    {
        ContactForm::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now()
       ]);

       return Redirect()
           ->route('contact')
           ->with('success', 'Your Message Send Succesfully');
    }


    public function AdminMessage()
    {
        $messages = ContactForm::latest()->paginate(5);
        return view('admin.contact.message', compact(('messages')));
    }
}
 