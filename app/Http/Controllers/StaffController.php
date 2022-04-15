<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function getStaff() {
        $staffs = Staff::paginate(10);
        $staffs->load('department');
        return view('staffs.index', compact('staffs'));
    }

    public function getStaffById($id) {
        $staff = Staff::find($id);
        $staff->load('department');
        return view('staffs.detail', compact('staff'));
    }

    public function addForm() {
        $departments = Department::all();
        return view('staffs.add', compact('departments'));
    }

    public function saveAdd(Request $request) {
        $model = new Staff();
        if($request->hasFile('avatar')){
            $imgPath = $request->file('avatar')->store('staffs');
            $imgPath = str_replace('public/', '', $imgPath);
            $model->avatar = $imgPath;
        }
        $model->fill($request->all());
        $model->save();
        return redirect(route('staff.index'))->with('message', 'Thêm mới nhân viên thành công!');
    }

    public function editForm($id) {
        $staff = Staff::find($id);
        $year = substr($staff->dob, 0, 4);
        $month = substr($staff->dob, 5, 2);
        $day = substr($staff->dob, 8, 2);
        $departments = Department::all();
        return view('staffs.edit', compact('staff', 'year', 'month', 'day', 'departments'));
    }

    public function saveEdit($id, Request $request) {
        $model = Staff::find($id);
        if($request->hasFile('avatar')){
            Storage::delete($model->avatar);
            $imgPath = $request->file('avatar')->store('staffs');
            $imgPath = str_replace('public/', '', $imgPath);
            $model->avatar = $imgPath;
        }
        $model->fill($request->all());
        $model->save();
        return redirect(route('staff.edit', ['id' => $id]))->with('message', 'Thay đổi thông tin nhân viên thành công!');
    }

    public function remove($id) {
        $model = Staff::find($id);
        $model_name = $model->name;
        if(!empty($model->avatar)) {
            Storage::delete($model->avatar);
        }
        $model->delete();
        return redirect(route('staff.index'))->with('message', 'Xóa thông tin nhân viên ' . $model_name . ' thành công!');
    }
}
