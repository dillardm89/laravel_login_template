<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Events\UserEvent;
use App\Jobs\SendEmailCode;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;


class CodeController
{
    /**
     * Generate and send email with validation code
     * @param Request $req
     * @return void
     */
    public function emailCode(Request $req)
    {
        try {
            $fields = $req->validate([
                'email' => ['required', 'email:rfc,dns'],
                'view' => 'required'
            ]);
        } catch (ValidationException $error) {
            return back()->withErrors($error->validator)->withInput()->with('codeStatus', 0)->with('failure', 'Invalid inputs. Please verify entries and try again.');
        };

        $userDetails = ['email' => $fields['email']];
        $codeValue = mt_rand(100000, 999999);
        $expiresAt = now()->addMinutes(10);
        $type = $fields['view'] == 'reset-password' ? 'reset' : 'new';

        $existingCode = Code::where('email', $fields['email'])->first();
        if ($existingCode != null) {
            $existingCode->delete();
        }

        $newCode = Code::create(['email' => $fields['email'], 'code' => $codeValue, 'expires_at' => $expiresAt]);
        if ($newCode == null) {
            return back()->with('codeStatus', 0)->with('userDetails', $userDetails)->with('failure', 'Send code via email failed. Please verify inputs and try again.');
        }

        dispatch(new SendEmailCode([
            'sendTo' => $fields['email'],
            'code' => $codeValue,
            'type' => $type
        ]));
        event(new UserEvent([
            'username' => $fields['email'],
            'action' => 'code sent to email'
        ]));
        Log::debug('email sent');
        return back()->with('codeStatus', 1)->with('userDetails', $userDetails)->with('success', 'Code sent. Please check your email and enter the code provided.');
    }

    /**
     * Validate email / code combination
     * @param Request $req
     * @return void
     */
    public function validateCode(Request $req)
    {
        try {
            $fields = $req->validate([
                'email' => ['required', 'email:rfc,dns'],
                'code' => ['required', 'min:6', 'max:6'],
                'view' => 'required'
            ]);
        } catch (ValidationException $error) {
            return back()->withErrors($error->validator)->withInput()->with('codeStatus', 1)->with('failure', 'Invalid inputs. Please verify entries and try again.');
        };

        $userDetails = ['email' => $fields['email']];
        $codeInt = intval($fields['code']);
        $existingCode = Code::where('email', $fields['email'])->where('code', $codeInt)->first();
        if ($existingCode == null) {
            $userDetails = ['email' => $fields['email']];
            return back()->with('codeStatus', 1)->with('userDetails', $userDetails)->with('failure', 'Invalid email / code combination. Please check inputs and try again.');
        }

        $expiresAt = Carbon::parse($existingCode->expires_at);
        $timeValid = $expiresAt->greaterThanorEqualTo(Carbon::now());
        if (!$timeValid) {
            return back()->with('codeStatus', 0)->with('userDetails', $userDetails)->with('failure', 'Code has expired. Please request a new code and try again.');
        }

        event(new UserEvent([
            'username' => $fields['email'],
            'action' => 'email validated'
        ]));
        return back()->with('codeStatus', 2)->with('userDetails', $userDetails);
    }
}
