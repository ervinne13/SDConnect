<?php

namespace App\Http\Controllers\Modules\System;

use App\Http\Controllers\Controller;
use App\Modules\System\User\UserAccount;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use function bcrypt;
use function redirect;
use function response;
use function view;

class UserController extends Controller
{

    public function edit()
    {
        return view('pages.user.update');
    }

    public function update(Request $request)
    {
        if ( !$request->image_url && !$request->password ) {
            return redirect()->to('/');
        }

        if ( $request->image_url ) {
//            $fileLocation = $request->file('image_url')->store('avatars');
            $fileLocation = Storage::disk('public_assets')->put('avatars', $request->image_url);
            UserAccount::whereUsername(Auth::user()->username)->update([
                'image_url' => $fileLocation
            ]);
        }

        if ( $request->password ) {

//            $request->validate([
//                'password' => 'required|confirmed',
//            ]);

            if ( $request->password == $request->password_confirmation ) {
                UserAccount::whereUsername(Auth::user()->username)->update([
                    'password' => bcrypt($request->password)
                ]);
            } else {
                return redirect()->back()->withErrors(['Passwords did not match']);
            }
        }

        return redirect()->back()->with('status', 'Profile updated!');
    }

    public function giveBadge(Request $request, $username)
    {
        $badgeId = $request->badge_id;

        try {
            $user = UserAccount::find($username);
            if ( !$user->badges->contains($badgeId) ) {
                $user->badges()->attach($badgeId);
            }
        } catch ( Exception $e ) {
            return response($e->getMessage(), 500);
        }
    }

}
