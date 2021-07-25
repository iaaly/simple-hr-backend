<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return "Backend server to <a href='" . env('FRONTEND_ADDRESS') . "'>Simple HR App</a>";
});

$router->group(['prefix' => 'departments'], function() use ($router) {
    $router->get('/',  ['uses' => 'DepartmentController@showAll']);
    $router->post('/',  ['uses' => 'DepartmentController@create']);
});

$router->group(['prefix' => 'employees'], function() use ($router) {
    $router->get('/',  ['uses' => 'EmployeeController@showAll']);
    $router->post('/',  ['uses' => 'EmployeeController@create']);
});

$router->group(['prefix' => 'reports'], function() use ($router) {
    $router->get('/101', ['uses' => 'ReportController@departmentsWithMaxSalary']);
    $router->get('/102', ['uses' => 'ReportController@highValueDepartments']);
});