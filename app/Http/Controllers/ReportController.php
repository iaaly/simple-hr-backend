<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
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

    public function departmentsWithMaxSalary() {
        $query = "SELECT d.*, coalesce(MAX(e.salary_amount), 0) AS max_salary 
        FROM departments d 
        LEFT JOIN employees e 
        ON d.id = e.department_id 
        GROUP BY d.id";

        return $this->fetchReport($query);
    }

    
    public function highValueDepartments() {
        $query = "SELECT d.*, COUNT(*) as high_earners
        FROM departments d 
        INNER JOIN employees e 
        ON d.id = e.department_id 
        WHERE e.salary_amount > 50000
        GROUP BY d.id
        HAVING high_earners > 2";

        return $this->fetchReport($query);
    }

    private function fetchReport($query) {
        return response()->json(DB::select($query), 200);
    }

}
