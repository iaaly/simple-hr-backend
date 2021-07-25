<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
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

    public function showAll() {
        return response()->json(DB::select("SELECT * FROM departments"), 200);
    }

    public function create(Request $request) {
        $title = $request->input('title');
        $description = $request->input('description');

        // Using DB:raw to protect against MYSQL injection and invalid characters. 
        $insert = DB::raw("INSERT INTO departments (`title`,`description`) 
        VALUES (:title, :description)");

        $result = DB::insert($insert, array('title' => $title,'description' => $description));
            
        return $result == 1 ? response()->make('', 201) : response()->make('', 400) ; 
    }

}
