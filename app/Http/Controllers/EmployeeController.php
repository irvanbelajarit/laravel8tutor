<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;

class EmployeeController extends Controller{

  public function index(){
    $employee =  Employees::all();
     return view('employee.index',compact('employee'));
  }

  public function getUsers($id = 0){

     if($id==0){
        $employees = Employees::orderby('id','asc')->select('*')->get();
     }else{
        $employees = Employees::select('*')->where('id', $id)->get();
     }
     // Fetch all records
     $userData['data'] = $employees;

     echo json_encode($userData);
     exit;
  }


}
