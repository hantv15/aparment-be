<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function getDepartment() {
        $departments = Department::paginate(10);
        $departments->load('staffs');
        return view('departments.index', compact('departments'));
    }

    public function getDepartmentById($id) {
        $department = Department::find($id);
        $department->load('staffs');
        return view('departments.detail', compact('department'));
    }

    public function addForm() {
        return view('departments.add');
    }

    public function saveAdd(Request $request) {
        $model = new Department();
        $model->fill($request->all());
        $model->save();
        return redirect(route('department.index'))->with('message', 'Thêm mới phòng ban thành công!');
    }

    public function editForm($id) {
        $department = Department::find($id);
        return view('departments.edit', compact('department'));
    }

    public function saveEdit($id, Request $request) {
        $model = Department::find($id);
        $model->fill($request->all());
        $model->save();
        return redirect(route('department.edit', ['id' => $id]))->with('message', 'Sửa phòng ban thành công!');
    }
}
