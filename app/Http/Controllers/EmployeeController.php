<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function showAll(Request $request) {

        $department_id = $request->department_id;

        
        $select =  $department_id ? "SELECT * FROM employees WHERE department_id = $department_id"
        : "SELECT * FROM employees";

        return response()->json(DB::select($select), 200);
    }


    public function create(Request $request) {

        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $position = $request->input('position');
        $salary_amount = $request->input('salary_amount');
        $salary_currency = $request->input('salary_currency');
        $department_id = intval($request->input('department_id'));

        $result = DB::insert("INSERT INTO employees (
            `first_name`, 
            `last_name`,
            `position`,
            `salary_amount`,
            `salary_currency`,
            `department_id`) VALUES (
                '$first_name', 
                '$last_name', 
                '$position', 
                $salary_amount, 
                '$salary_currency', 
                $department_id)");

        return $result == 1 ? response()->make('', 201) : response()->make('', 400) ; 
    }
}
