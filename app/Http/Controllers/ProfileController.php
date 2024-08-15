<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\User;
use App\Events\UserEvent;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;

class ProfileController extends Controller
{
    /**
     * Display user profile as home page
     * @return void
     */
    public function home()
    {
        $user = auth()->user();
        return view('home', ['user' => $user, 'editAvatar' => false]);
    }

    /**
     * Display edit avatar form
     * @return void
     */
    public function displayEditAvatar()
    {
        return view('home', ['user' => auth()->user(), 'editAvatar' => true]);
    }

    /**
     * Save user avatar image
     * @param Request $req
     * @return void
     */
    public function saveAvatar(Request $req)
    {
        $req->validate([
            'avatar' => ['required', 'image', 'max:2048']
        ]);
        $user = $req->user();
        $filename = 'user' . $user->id . '-' . uniqid() . '.png';
        $imgManager = new ImageManager(new Driver());
        $image = $imgManager->read($req->file('avatar'));
        $imgData = $image->cover(225, 225)->toJpeg();
        Storage::put("/public/avatars/{$filename}", $imgData);

        if ($user->avatar != '/assets/default-avatar.png') {
            Storage::delete(str_replace('/storage/', 'public/', $user->avatar));
        }

        $user->avatar = $filename;
        $user->save();
        event(new UserEvent([
            'username' => $user->username,
            'action' => 'avatar updated'
        ]));
        return redirect('/home')->with('success', 'Avatar successfully updated.');
    }

    /**
     * Delete user account
     * @param User $user
     * @return void
     */
    public function deleteAccount(User $user)
    {
        if (auth()->user()->username == $user->username) {
            $code = Code::where('email', $user->email)->first();
            if ($code != null) {
                $code->delete();
            }

            $username = $user->username;
            $user->delete();
            auth()->logout();
            event(new UserEvent([
                'username' => $username,
                'action' => 'deleted account'
            ]));
            return redirect('/')->with('success', 'Your account was successfully deleted.');
        } else {
            return redirect('/home')->with('failure', 'You are not authorized to delete the account.');
        }
    }
}
