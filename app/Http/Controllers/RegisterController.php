<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\RegistrationMail;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /**
     * Display register page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('auth.register');
    }

    /**
     * Handle account registration request
     * 
     * @param RegisterRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $email = $request->get('email');
        $company = $request->get('company');
        User::create($request->validated());
        $this->sendEmail($email, $company);
        return redirect('login')->with('success', "Account successfully registered. Please login");
    }

    public function sendEmail($email, $company)
    {
        $data = ['company' => $company];
        Mail::to($email)->send(new RegistrationMail($data));
    }

    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function refreshCaptcha()
    // {
    //     return response()->json(['captcha' => captcha_img()]);
    // }
}
