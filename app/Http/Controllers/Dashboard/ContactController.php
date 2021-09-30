<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\User;
use Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->data['contacts'] = Contact::when($request->status,function($q) use($request) {
            $q->where('read_at', null);
        })->latest()->get();
        return view('dashboard.contact.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Contact::find($id)) {
            return redirect()->route('dashboard.contact.index')->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        $this->data['contact'] = Contact::find($id);
        $this->data['contact']->update(['read_at' => now()]);
        return view('dashboard.contact.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Contact::find($id)) {
            $response = ['status' => 'false', 'message' => trans('dash.messages.try_2_access_not_found_content')];
            return $response;
        }
        $contact = Contact::find($id)->forceDelete();
        return ['status' => 'true', 'message' => trans('dash.messages.deleted_successfully')];
    }

    public function reply(Request $request)
    {
        $user = User::find($request->email);
        Mail::send('mails.contact', $request->all(), function ($message) use ($request) {
            $message->from(settings('formal_email_message'), settings('project_name_' . app()->getLocale()));
            $message->sender(settings('formal_email_message'), settings('project_name_' . app()->getLocale()));
        
            $message->to($request->email, '');
    
            $message->replyTo(settings('formal_email_message'), settings('project_name_' . app()->getLocale()));
        
            $message->subject('رسالة إدارية');
        
            $message->priority(1);
        
            // $message->attach('pathToFile');
        });
        // ::to($user)->send(new ReplyContact($request->all()));
        return redirect()->route('dashboard.contact.index')->with('class', 'success')->with('message', trans('dash.messages.sent_successfully'));
    }
}
