<?php

namespace Nrz\User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use mysql_xdevapi\Result;
use Nrz\User\Http\Requests\SendResetPasswordRequest;
use Nrz\User\Http\Requests\VerifyCodeRequest;
use Nrz\User\Model\User;
use Nrz\User\Repo\UserRepo;
use Nrz\User\Services\verifyCodeService;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function showVerifyCodeRequestForm()
    {
        return view('User::Front.auth.passwords.email');
    }


    public function sendVerifyCodeEmail(SendResetPasswordRequest $request)
    {
        $user = resolve(UserRepo::class)->findByEmail($request->email);
        if ($user && !VerifyCodeService::has($user->id)) {
            $user->sendResetPasswordRequest();
            return view('User::Front.auth.passwords.enter-verify-code-form');
        } elseif (VerifyCodeService::has($user->id)) {
            return view('User::Front.auth.passwords.enter-verify-code-form');
        } else {
            return redirect(route('login'));
        }
    }


    public function checkVerifyCode(VerifyCodeRequest $request)
    {
        $user = resolve(UserRepo::class)->findByEmail($request->email);


        if ($user == null || ! verifyCodeService::check($user->id, $request->verify_code)) {
            return back()->withErrors(['verify_code' => 'کد وارد شده صحیح نیست']);
        }
        auth()->loginUsingId($user->id);
        return redirect(route('password.showResetForm'));
    }

}
