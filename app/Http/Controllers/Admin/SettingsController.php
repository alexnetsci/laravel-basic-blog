<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use Session;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function settings()
    {
        $settings = Setting::latest()->take(1)->get();

        return view('admin.settings.settings', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Setting $setting)
    {
        $uniqueNameRule = Rule::unique('settings')->ignore($setting->id);
        $validatedArticleTitle = request()->validate([
            'articles_title' => ['bail', 'required', 'string', 'max:255', $uniqueNameRule],
        ]);

        $setting->update($validatedArticleTitle);
        $setting->articles_title = request()->articles_title;
        $setting->save();
        
        Session::flash('success', 'Article title has been changed!');

        return redirect()->back();
    }
}
