<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class FeedbackController extends Controller
{   
    public function getFeedback(){
        return view('feedbacks.feedback');
    }

    public function sendFeedback(Request $request){  
        $users = User::where('role',0)->get();      
        foreach($users as $user){
            Mail::send('email.feedback', ['feedback' => 'abc'], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Phản hồi từ khách hàng');
            });
        }
    }
}
