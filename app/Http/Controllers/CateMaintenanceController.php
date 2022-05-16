<?php

namespace App\Http\Controllers;

use App\Models\Maintenancecategory;
use Illuminate\Http\Request;

class CateMaintenanceController extends Controller
{
    public function index(Request $request){
        $model = Maintenancecategory::all();
        return view('cateMaintenances.index',compact('model'));
    }
    public function addForm(){
        
        return view('cateMaintenances.add');
    }
    public function saveAdd(Request $request){
        $model = new Maintenancecategory();
        $model->fill($request->all());
        $model->save();

        return redirect(route('category-maintenance.index'))->with('msg','Thêm Thành Công');

    }
    public function editForm($id){
        $model = Maintenancecategory::find($id);
        return view('cateMaintenances.edit',compact('model'));

    }
    public function saveEdit(Request $request, $id){
        $model = Maintenancecategory::find($id);
        $model->fill($request->all());
        return redirect(route('category-maintenance.index'))->with('msg','Sửa Thành Công');

    }
    public function remove($id){
        $model = Maintenancecategory::find($id);
        $model->delete();
        return redirect(route('category-maintenance.index'))->with('msg','Xóa Thành Công');


    }
}
