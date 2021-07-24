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
        return DB::select("SELECT * FROM departments");
    }

    public function create(Request $request) {
        $title = $request->input('title');
        $description = $request->input('description');

        $result = DB::insert("INSERT INTO departments (
            `title`, 
            `description`) VALUES (
            '$title', 
            '$description')");
        return $result;
    }

}
