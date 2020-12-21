<?php

namespace App\Http\Controllers;

use App\Models\Kaboom;
use Illuminate\Http\Request;


class SearcherKab extends Controller
{
    public function index(){
        return view('employees.index');
    }

    public function getEmployees(Request $request){

        $search = $request->search;

        if($search == ''){
            $employees = Kaboom::orderby('name','asc')->get();
        }else{
            $employees = Kaboom::orderby('name','asc')->select('name','points')->where('name', 'like', '%' .$search . '%')->get();
        }

        $response = array();
        foreach($employees as $employee){
            $response[] = array("value"=>$employee->points,"label"=>$employee->name);
        }

        return response()->json($response);
    }
}
