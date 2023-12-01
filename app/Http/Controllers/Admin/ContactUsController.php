<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUsMessage;

class ContactUsController extends Controller
{
    public function index()
    {
        $messages = ContactUsMessage::latest()->paginate(25);
        return view('admin.ContactMessages.index', compact('messages'));

    }

    public function show(ContactUsMessage $contact)
    {
        return view('admin.ContactMessages.show', compact('contact'));
    }
}
