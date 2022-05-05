<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('clients.index');
    }
    // public function getFeedback(){
    //     return view('feedbacks.feedback');
    // }

    public function sendFeedback(Request $request){  
        $feedback = new Feedback();
        $uApart = Auth::user()->apartment_id;
        $building_id = User::join('apartments','users.apartment_id','apartments.id')
        ->join('buildings','apartments.building_id','buildings.id')
        ->where('users.id',5)
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
}
