<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('teacher.profile');
    }

    public function upload_profile_picture(Request $request)
    {
        if (strpos(auth()->user()->avatar, 'images/avatar.png') === false) {

            ImageService::deleteProfilePicture(auth()->user()->avatar);
        }
        $profile_picture = ImageService::store_base64_profile_picture($request->image);

        auth()->user()->update([
            'avatar' => $profile_picture
        ]);

        return response()->json(['success' => true, 'img' => asset($profile_picture), 'message' => __('site.profile_p_changed')], 200);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'digits:11|unique:users,mobile,' . auth()->user()->id
        ]);

        auth()->user()->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'mobile' => $request->mobile,
        ]);

        session()->flash('success', __('site.profile_d_changed'));
        return redirect()->back();
    }

    public function update_password(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required|min:6',
            'password' => 'required|min:6|confirmed',
        ]);

        if (Hash::check($request->old_password, auth()->user()->password)) {
            auth()->user()->update([
                'password' => bcrypt($request->password),
            ]);
            session()->flash('success', __('site.password_changed'));
        } else {
            session()->flash('error', __('site.old_password_incorrect'));
        }

        return redirect()->back();
    }
}
