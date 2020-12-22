<?php

namespace Nrz\User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Nrz\User\Http\Requests\VerifyCodeRequest;
use Nrz\User\Services\verifyCodeService;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('User::Front.auth.verify');
    }

    public function verify(VerifyCodeRequest $request)
    {
        $code = verifyCodeService::get(auth()->id());

        $status = verifyCodeService::check(auth()->id(), $code);
        if ($status) {
            auth()->user()->markEmailAsVerified();
            return redirect(route('home'));
        }
        return back()->withErrors(['verify_code' => 'کد وارد شده صحیح نمیباشد']);


    }

}
