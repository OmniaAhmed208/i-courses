<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ImageService;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function update_general_settings(Request $request)
    {
        $this->validate($request, [
            'website_name' => 'required|string|min:3',
            'header_title_en' => 'required|string|min:3',
            'header_title_ar' => 'required|string|min:3',
            'header_slogan_en' => 'string',
            'header_slogan_ar' => 'string',
            'website_color' => 'required|string',
            'can_upload_pp' => 'required|string|in:on,off'
        ]);
        setting(['website_name' => $request->website_name])->save();
        setting(['header_title_en' => $request->header_title_en])->save();
        setting(['header_title_ar' => $request->header_title_ar])->save();
        setting(['header_slogan_en' => $request->header_slogan_en])->save();
        setting(['header_slogan_ar' => $request->header_slogan_ar])->save();
        setting(['can_upload_pp' => $request->can_upload_pp])->save();
        setting(['website_color' => $request->website_color])->save();

        session()->flash('success', __('site.general_settings_updated_successfully'));
        return redirect()->back();
    }

    public function update_website_pictures(Request $request)
    {
        $this->validate($request, [
            '_image_type' => 'required|string'
        ]);

        if (setting($request['_image_type'])) {
            ImageService::deleteWebsiteImage(setting($request['_image_type']));
        }

        setting([$request['_image_type'] => ImageService::storeWebsiteImage($request->image)])->save();

        session()->flash('success', __('site.website_image_updated'));
        return redirect()->back();
    }

    public function update_animated_code_status(Request $request)
    {
        $this->validate($request, [
            'show_code' => 'required|string|in:on,off'
        ]);

        setting(['code.status' => $request->show_code])->save();

        session()->flash('success', __('site.code_status_updated'));
        return redirect()->back();
    }

    public function update_mobile_links(Request $request)
    {
        setting(['google_play_link' => $request->google_play_link])->save();
        setting(['app_store_link' => $request->app_store_link])->save();

        session()->flash('success', __('site.mobile_links_updated'));
        return redirect()->back();
    }

    public function update_social_links(Request $request)
    {
        $this->validate($request, [
            'whatsapp' => 'nullable|digits:11'
        ]);
        setting(['facebook' => $request->facebook])->save();
        setting(['instagram' => $request->instagram])->save();
        setting(['whatsapp' => $request->whatsapp])->save();
        setting(['youtube' => $request->youtube])->save();

        session()->flash('success', __('site.social_links_updated'));
        return redirect()->back();
    }
}
