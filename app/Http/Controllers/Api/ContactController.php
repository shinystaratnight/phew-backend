<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Http\Requests\Api\Contact\{ContactRequest};
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact(ContactRequest $request)
    {
        $contact = Contact::create($request->validated());
        return response()->json(['status' => 'true', 'message' => trans('app.messages.sent_successfully'), 'data' => null], 200);
    }
}
