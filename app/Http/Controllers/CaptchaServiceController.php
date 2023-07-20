<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CaptchaServiceController extends Controller
{
   
    public function capthcaFormValidate(Request $request)
    {
        $request->validate([
            'secret_password' => 'required',
            'captcha' => 'required|captcha'
        ]);

        if(!auth()->user()->roles->pluck('secret_access')[0]) return redirect()->route("secret.forbidden");


        if (Auth::attempt(['email' => Auth::user()->email, 'password' => $request->secret_password])){
       
            Session::put("secret-page-access",true);
            return redirect()->route('dukkesops.werving.index');
       
        }else{

            return back()->with('error', 'Password anda salah. Silahkan ulangi kembali!');

        }

       
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img("flat")]);
    }

}
