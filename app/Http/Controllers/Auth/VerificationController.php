<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function notice()
    {
        return view('email.notice');
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return view('auth.login');
    }

    public function send(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return view('email.resend');
    }
}
