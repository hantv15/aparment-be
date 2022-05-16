<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{   
    public function getFeedback(){
        return view('feedbacks.feedback');
    }

    public function sendFeedback(Request $request){  
        $feedback = new Feedback();
        $uApart = Auth::user()->apartment_id;
        $building_id = User::join('apartments','users.apartment_id','apartments.id')
        ->join('buildings','apartments.building_id','buildings.id')
        ->where('users.id',Auth::user()->id)
        ->select('buildings.id')
        ->first()
        ;
        // dd($building_id);
        $feedback->fill($request->all());
        $feedback->building_id = $building_id->id;
        $feedback->save();
        // $users = User::where('role',0)->get();   
        $users = Building::join('apartments','buildings.id','apartments.building_id')
        ->join('users','apartments.id','users.apartment_id')
        ->where('buildings.id',$building_id->id)
        ->select('users.*')
        ->get();
        
        foreach($users as $user){
            Mail::send('email.feedback', ['feedback' => $request->content], function ($message) use ($user,$request) {
                $message->to($user->email);
                $message->subject($request->subject);
            });
        }
    }
    public function listFeedback(Request $request ){
        $feedbacks = Feedback::all();
        $buildings = Building::all();
        return view('feedbacks.index',compact('feedbacks','buildings'));
    }
    public function getFeedbackById($id ){
        $feedback = Feedback::find($id);
        
        return view('feedbacks.feedbackId',compact('feedback'));
    }
    public function remove($id){
        $feedback = Feedback::find($id);
        $feedback->delete();
        return redirect(route('feedback.list'));
    }
}
