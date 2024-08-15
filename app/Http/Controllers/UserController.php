<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Events\UserEvent;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display user registration page
     * @return void
     */
    public function register()
    {
        return view('register')->with('codeStatus', 0);
    }

    /**
     * Display user login page
     * @return void
     */
    public function login()
    {
        return view('login')->with('codeStatus', 0);
    }

    /**
     * Display reset password page
     * @return void
     */
    public function resetPassword()
    {
        return view('reset-password')->with('codeStatus', 0);
    }

    /**
     * Authenticate and login existing user
     * @param Request $req
     * @return void
     */
    public function authenticate(Request $req)
    {
        try {
            $fields = $req->validate([
                'email' => ['required', 'email:rfc,dns'],
                'password' => 'required',
            ]);
        } catch (ValidationException $error) {
            return back()->withErrors($error->validator)->withInput()->with('codeStatus', 2)->with('failure', 'Invalid inputs. Please verify entries and try again.');
        };


        $saveLogin = $req->has('remember-checkbox');

        if (auth()->attempt([
            'email' => $fields['email'],
            'password' => $fields['password']
        ])) {
            $user = auth()->user();
            $req->session()->regenerate();
            event(new UserEvent([
                'username' => $user->username,
                'action' => 'login'
            ]));

            if ($saveLogin) {
                config(['session.expire_on_close' => false]);
            } else {
                config(['session.expire_on_close' => true]);
            }
            return redirect('/home')->with('success', 'You have successfully logged in.');
        } else {
            $userDetails = ['email' => $fields['email']];
            return back()->with('codeStatus', 2)->with('userDetails', $userDetails)->with('failure', 'Invalid login credentials. Please verify inputs and try again, or switch to register instead.');
        }
    }

    /**
     * Register and login new user
     * @param Request $req
     * @return void
     */
    public function signUp(Request $req)
    {
        try {
            $fields = $req->validate([
                'first_name' => ['required', 'min:5', 'max:50'],
                'last_name' => ['required', 'min:5', 'max:50'],
                'email' => ['required', 'email:rfc,dns', Rule::unique('users', 'email')],
                'username' => ['required', 'min:5', 'max:20', Rule::unique('users', 'username')],
                'password' => ['required', 'min:8', 'max:20', 'confirmed']
            ]);
        } catch (ValidationException $error) {
            return back()->withErrors($error->validator)->withInput()->with('codeStatus', 2)->with('failure', 'Invalid inputs. Please verify entries and try again.');
        };

        $saveLogin = $req->has('remember-checkbox');
        $fields['password'] = bcrypt($fields['password']);
        $user = User::create($fields);
        if ($user) {
            auth()->login($user);
            event(new UserEvent([
                'username' => $user->username,
                'action' => 'register'
            ]));

            if ($saveLogin) {
                config(['session.expire_on_close' => false]);
            } else {
                config(['session.expire_on_close' => true]);
            }
            return redirect('/home')->with('success', 'Thank you for created an account.');
        } else {
            $userDetails = [
                'email' => $fields['email'],
                'username' => $fields['username'],
                'first_name' => $fields['first_name'],
                'last_name' => $fields['last_name']
            ];
            return back()->with('codeStatus', 2)->with('userDetails', $userDetails)->with('failure', 'Sign up failed. Please verify inputs and try again, or switch to login instead.');
        }
    }

    /**
     * Update password and login existing user
     * @param Request $req
     * @return void
     */
    public function updatePassword(Request $req)
    {
        try {
            $fields = $req->validate([
                'email' => ['required', 'email:rfc,dns'],
                'password' => ['required', 'min:8', 'max:20', 'confirmed']
            ]);
        } catch (ValidationException $error) {
            return back()->withErrors($error->validator)->withInput()->with('codeStatus', 2)->with('failure', 'Invalid inputs. Please verify entries and try again.');
        };

        $saveLogin = $req->has('remember-checkbox');
        $hashedPassword = bcrypt($fields['password']);
        $user = User::where('email', $fields['email'])->first();
        if ($user) {
            $user->password = $hashedPassword;
            $user->save();
            $req->session()->regenerate();
            event(new UserEvent([
                'username' => $user->username,
                'action' => 'reset password'
            ]));

            if ($saveLogin) {
                config(['session.expire_on_close' => false]);
            } else {
                config(['session.expire_on_close' => true]);
            }
            return redirect('/home')->with('success', 'You have successfully reset your password.');
        } else {
            $userDetails = ['email' => $fields['email']];
            return back()->with('codeStatus', 2)->with('userDetails', $userDetails)->with('failure', 'Reset password failed. Please check inputs and try again, or switch to register instead.');
        }
    }

    /**
     * Logout user
     * @return void
     */
    public function logout()
    {
        $user = auth()->user();
        event(new UserEvent([
            'username' => $user->username,
            'action' => 'logout'
        ]));
        auth()->logout();
        return redirect('/')->with('success', 'You are now logged out.');
    }
}
