<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class FeedbackController extends Controller
{   
    
    public function sendFeedback(Request $request){        
        Mail::send('email.feedback', ['feedback' => $request->feedback], function ($message) {
            $message->to('anhndph12795@fpt.edu.vn');
            $message->subject('Phản hồi từ khách hàng');
        });
        return $this->success($request->feedback);
    }
}
