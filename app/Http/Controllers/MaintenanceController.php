<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Maintenancecategory;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class MaintenanceController extends Controller
{
    public function addForm(){
        $categories = Maintenancecategory::all();
        return view('maintenances.add',compact('categories'));
    }
    public function getMaintenance(){
        $model = Maintenance::all();
        return view('maintenances.index',compact('model'));
    }


    
}
