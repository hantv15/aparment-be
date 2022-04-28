<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Building;
use App\Models\Maintenance;
use App\Models\Maintenancecategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use function Ramsey\Uuid\v1;

class MaintenanceController extends Controller
{
   
    public function getMaintenance(){
        $model = Maintenance::all();
        $buildings = Building::all();
        foreach($model as $key =>$item){
            if($item->progress >= 100){
                $modelRemove = Maintenance::find($item->id);
                $modelRemove->delete();
            }
        };
        
        return view('maintenances.index',compact('model','buildings'));
    }
    public function addForm(){
        $categories = Maintenancecategory::all();
        $buildings = Building::all();
        
        return view('maintenances.add',compact('categories','buildings'));

    }
    public function saveAdd( Request $request)
    {
        $model = new Maintenance();
        $check = Maintenance::where('maintenance_id',$request->maintenance_id)
        ->Where('building_id',$request->building_id)
        ->count();
        ;
        
        if($check==1){
            return back()->with('msg','Hang mục bảo trì đang tồn tại');
        }
        $time= Carbon::now('Asia/Ho_Chi_Minh');
        $year = $time->year;
        $month = $time->month;
        $day = $time->day;
        $model->fill($request->all());
        $model->year = $year;
        $model->month = $month;
        $model->day = $day;
        $model->building_id = $request->building_id;
        $model->save();
        
        $maintenance = Maintenance::join('maintenance_category' ,'maintenances.maintenance_id','maintenance_category.id')
        ->where('maintenances.id',$model->id)
        ->select('maintenance_category.name')
        ->first();
       
        // dd($maintenance);
        $users = Apartment::join('users','apartments.id','users.apartment_id')
        ->where('building_id',$request->building_id)
        ->get()
        ;
    
      
        
        
        foreach($users as $user){
            Mail::send('email.maintenances', ['name'=>$maintenance->name,'month' =>$model->month,'day' =>$model->day,'year' =>$model->year], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Thông báo bảo trì' );
            });
        }
        return redirect(route('maintenance.index'));
    }
    public function editForm($id){
        $model = Maintenance::find($id);
        
        return view('maintenances.edit',compact('model'));
    }
    public function saveEdit( Request $request, $id){
        $model =  Maintenance::find($id);
        $model->fill($request->all());
        $model->save();
        
        return redirect(route('maintenance.index'));
    }
    public function remove($id){
        $model =  Maintenance::find($id);
        if(!$model){
            return redirect(route('maintenance.index'));
        }
        $model->delete();
        return redirect(route('maintenance.index'));
    }
    
}
