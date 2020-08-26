<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

route::get('Homepage', ['uses' => 'PagesController@viewHomepage', 'as' => 'Homepage']);
route::get('StudentLogin' ,['uses' => 'PagesController@viewStudentLogin' , 'as' => 'StudentLogin']);
route::get('Dashboard' ,['uses' => 'PagesController@viewDashboard' , 'as' => 'Dashboard']);
Route::get('AccountLogout', ['uses' => 'PagesController@accountLogout', 'as' => 'AccountLogout']);

// User Controller
Route::post('StudentRegister', ['uses' => 'UserController@postRegister', 'as' => 'StudentRegister']);
Route::post('StudentLogin', ['uses' => 'UserController@postLogin', 'as' => 'StudentLogin']);

//Resources

Route::resource('Schedule', 'ScheduleController');

// Ajax Controller

Route::get('viewOrganization/{id}', ['uses' => 'Ajax\RegisterAjax@viewOrganization' , 'as' => 'viewOrganization']);
