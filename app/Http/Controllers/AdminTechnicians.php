<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminTechnicians extends Controller
{
    public function get(){
        $models = User::where('role_id', 1)->orWhere('role_id', 2)->get();
        $models->load('role');
        return view('adminTechnicians.index',compact('models'));
    }
    public function addForm(){
        $roles = Role::all();
        return view('adminTechnicians.add',compact('roles'));
    }
    public function saveAdd(AdminRequest $request){
        $model = new User();
        $model->fill($request->all());
        $model->password = Hash::make('12345678');
        $model->save();
        Mail::send('email.register-admin', [
            'name' => $request->name,
           
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => '12345678'
        ], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Chào mừng thanh viên mới!');
        });
        return redirect(route('admin-technicians.index'));
    }
    public function editForm($id){
        $model = User::find($id);
        $roles = Role::all();
        return view('adminTechnicians.edit',compact('model','roles'));
    }
    public function saveEdit(AdminRequest $request, $id){
        $model = User::find($id);
        $model->fill($request->all());
        $model->save();
        return redirect(route('admin-technicians.index'));
    }
    public function remove($id){
        $model = User::find($id);
      
        $model->delete();
        return redirect(route('admin-technicians.index'));
    }
}
