<?php

namespace App\Http\Controllers\Light;


use App\Http\Controllers\Dark\BaseController;
use App\Http\Controllers\Light\Request\ContactRequest;
use App\Mail\ContactMail;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class ContactController extends BaseController
{
    public function contact()
    {
        return View::make('Light.contact');
    }

    public function store(ContactRequest $request)
    {
        $inputs = $request->validated();
        Contact::query()->create($inputs);
        $adminEmail = "your_admin_email@gmail.com";
        Mail::to($adminEmail)->send(new ContactMail($inputs));

        return redirect()->back()
            ->with(['success' => 'Thank you for contact us. we will contact you shortly.']);
    }
}
