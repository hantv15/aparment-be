<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class FeedbackController extends Controller
{   
    public function getFeedback(){
        return view('feedbacks.feedback');
    }

    public function sendFeedback(Request $request){  
        $feedback = new Feedback();
        $feedback->fill($request->all());
        $feedback->save();
        $users = User::where('role',0)->get();   
       
        foreach($users as $user){
            Mail::send('email.feedback', ['feedback' => $request->content], function ($message) use ($user,$request) {
                $message->to('anhndph12795@fpt.edu.vn');
                $message->subject($request->subject);
            });
        }
    }
    public function listFeedback(Request $request ){
        $feedbacks = Feedback::all();
        return view('feedbacks.index',compact('feedbacks'));
    }
    public function getFeedbackById($id ){
        $feedback = Feedback::find($id);
        
        return view('feedbacks.feedbackId',compact('feedback'));
    }

}
