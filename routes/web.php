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

// Pages Controller
route::get('Homepage', ['uses' => 'PagesController@viewHomepage', 'as' => 'Homepage']);
route::get('StudentLogin' ,['uses' => 'PagesController@viewStudentLogin' , 'as' => 'StudentLogin']);
route::get('Dashboard' ,['uses' => 'PagesController@viewDashboard' , 'as' => 'Dashboard']);
Route::get('AccountLogout', ['uses' => 'PagesController@accountLogout', 'as' => 'AccountLogout']);

// User Controller
// Route::post('StudentRegister', ['uses' => 'UserController@postRegister', 'as' => 'StudentRegister']);
Route::post('StudentLogin', ['uses' => 'UserController@postLogin', 'as' => 'StudentLogin']);

// Approver Controller
Route::get('Student-Approval-List',[ 'uses' => 'ApproverController@listofApproval', 'as' => 'ApprovalList']);
Route::get('Student-Approval-View/{id}',[ 'uses' => 'ApproverController@viewofApproval', 'as' => 'viewApprovalList']);
Route::get('Student-Document/{id}', ['uses' => 'ApproverController@getDocument', 'as' => 'getFile']);
Route::post('Student-Schedule-Approving', ['uses' => 'ApproverController@schedule_approving', 'as'=>'ScheduleApproving']);

//Resources

Route::resource('Schedule', 'ScheduleController');

// Ajax Controller Register Ajax

Route::get('viewOrganization/{id}', ['uses' => 'Ajax\RegisterAjax@viewOrganization' , 'as' => 'viewOrganization']);
Route::get('viewDivision/{id}', ['uses' => 'Ajax\RegisterAjax@viewDivision' , 'as' => 'viewDivision']);

// Ajax Controller Schedule Ajax

Route::get('viewDepartment/{id}', ['uses' => 'Ajax\ScheduleController@viewDepartment', 'as' => 'viewDepartment']);



// Google Account



Route::get('google', [ 'uses' => 'GoogleController@redirectToGoogle' , 'as' => 'redirect']);
Route::get('auth/google/callback', ['uses' => 'GoogleController@handleGoogleCallback' , 'as' => 'callback']);
