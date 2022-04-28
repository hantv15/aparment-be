<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function showForgetPasswordForm()
    {
        return view('auth.forgetPassword');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

       
        $token = rand(11111,99999);
        $email= $request->email;
        
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        MaiL::send('email.forgetPassword', ['token' => $token,'email'=>$email], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Thông báo đổi mật khẩu');
        });

        return redirect(route('reset.password.get'));
        // return view('auth.forgetPasswordLink',compact('email'));
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function showResetPasswordForm()
    {
        return view('auth.forgetPasswordLink');
        // , ['token' => $token]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
            'token'=>'required'
        ]);
            
        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            // return $this->back();
        }
        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
        

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return 1;

        // return redirect('/api/login')->with('message', 'Your password has been changed!');
    }
}
