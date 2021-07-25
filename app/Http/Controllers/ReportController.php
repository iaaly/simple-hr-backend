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
        $query = "SELECT d.id, d.title, coalesce(MAX(e.salary_amount), 0)  AS `value`
        FROM departments d 
        LEFT JOIN employees e 
        ON d.id = e.department_id 
        GROUP BY d.id, d.title";

        return $this->fetchReport($query);
    }

    
    public function highValueDepartments() {
        $query = "SELECT d.id, d.title, COUNT(*) as `value`
        FROM departments d 
        INNER JOIN employees e 
        ON d.id = e.department_id 
        WHERE e.salary_amount > 50000
        GROUP BY d.id
        HAVING `value` > 2";

        return $this->fetchReport($query);
    }

    public function employeesRepartition() {
        $query = "SELECT d.title, COUNT(*) as employees_count
        FROM departments d
        INNER JOIN employees e
        ON d.id = e.department_id
        GROUP BY d.title";

        return $this->fetchReport($query);
    }

    private function fetchReport($query) {
        return response()->json(DB::select($query), 200);
    }

}
