<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\General\ImageController;
use App\Models\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $definition_video = Setting::where('key', 'definition_video')->first();
        return view('dashboard.settings.index', compact('definition_video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->dashboard_name_ar)
            Setting::where('key', 'dashboard_name_ar')->update(['value' => $request->dashboard_name_ar]);
        if ($request->dashboard_name_en)
            Setting::where('key', 'dashboard_name_en')->update(['value' => $request->dashboard_name_en]);
        if ($request->project_name_ar)
            Setting::where('key', 'project_name_ar')->update(['value' => $request->project_name_ar]);
        if ($request->project_name_en)
            Setting::where('key', 'project_name_en')->update(['value' => $request->project_name_en]);
        if ($request->mobile)
            Setting::where('key', 'mobile')->update(['value' => $request->mobile]);
        if ($request->email)
            Setting::where('key', 'email')->update(['value' => $request->email]);
        if ($request->formal_email_message)
            Setting::where('key', 'formal_email_message')->update(['value' => $request->formal_email_message]);
        if ($request->facebook_url)
            Setting::where('key', 'facebook_url')->update(['value' => $request->facebook_url]);
        if ($request->twitter_url)
            Setting::where('key', 'twitter_url')->update(['value' => $request->twitter_url]);
        if ($request->youtube_url)
            Setting::where('key', 'youtube_url')->update(['value' => $request->youtube_url]);
        if ($request->instagram_url)
            Setting::where('key', 'instagram_url')->update(['value' => $request->instagram_url]);
        if ($request->whatsapp_phone)
            Setting::where('key', 'whatsapp_phone')->update(['value' => $request->whatsapp_phone]);
        if ($request->copy_write_ar)
            Setting::where('key', 'copy_write_ar')->update(['value' => $request->copy_write_ar]);
        if ($request->copy_write_en)
            Setting::where('key', 'copy_write_en')->update(['value' => $request->copy_write_en]);
        if ($request->about_client_ar)
            Setting::where('key', 'about_client_ar')->update(['value' => $request->about_client_ar]);
        if ($request->about_client_en)
            Setting::where('key', 'about_client_en')->update(['value' => $request->about_client_en]);
        if ($request->conditions_terms_ar)
            Setting::where('key', 'conditions_terms_ar')->update(['value' => $request->conditions_terms_ar]);
        if ($request->conditions_terms_en)
            Setting::where('key', 'conditions_terms_en')->update(['value' => $request->conditions_terms_en]);

        if ($request->google_map_key)
            Setting::where('key', 'google_map_key')->update(['value' => $request->google_map_key]);
        
        return redirect()->route('dashboard.setting.index')->with('class', 'success')->with('message', trans('dash.messages.updated_successfully'));
    }
}
