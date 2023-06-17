<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ContactUsMessage;

class ContactUsController extends Controller
{
    public function index()
    {
        return view('website.contactUs');
    }

    public function store(StoreContactMessageRequest $request)
    {
        ContactUsMessage::create($request->validated());
        session()->flash('success', __('site.message_sent_successfully'));
        return redirect()->back();
    }
}
