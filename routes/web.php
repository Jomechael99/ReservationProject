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
route::get('TicketingLogin', ['uses' => 'PagesController@viewTicketingLogin', 'as' => 'TicketingLogin']);

// User Controller
// Route::post('StudentRegister', ['uses' => 'UserController@postRegister', 'as' => 'StudentRegister']);
Route::post('StudentLogin', ['uses' => 'UserController@postLogin', 'as' => 'StudentLogin']);

// Approver Controller
Route::get('Student-Approval-List',[ 'uses' => 'ApproverController@listofApproval', 'as' => 'ApprovalList']);
Route::get('Student-Approval-View/{id}',[ 'uses' => 'ApproverController@viewofApproval', 'as' => 'viewApprovalList']);
Route::get('Student-Document/{id}', ['uses' => 'ApproverController@getDocument', 'as' => 'getFile']);
Route::post('Student-Schedule-Approving', ['uses' => 'ApproverController@schedule_approving', 'as'=>'ScheduleApproving']);

// EMO Controller

route::get('EMO/Student-Approval-List', ['uses' => 'EMOController@viewSchedule', 'as' => 'viewEmoList']);
Route::get('EMO/Student-Approval-View/{id}',[ 'uses' => 'EMOController@viewofApproval', 'as' => 'viewEmoListApproved']);
Route::get('EMO/Student-Approval-Edit/{id}',[ 'uses' => 'EMOController@viewEditApproval', 'as' => 'viewEditApproval']);
Route::post('EMO/Student-Approval-Edit',[ 'uses' => 'EMOController@editApproval', 'as' => 'editApproval']);
Route::post('EMO/Student-Schedule-Approving', ['uses' => 'EMOController@schedule_approving', 'as'=>'EmoApproving']);

// Ticketing Controller

Route::get('Ticketing/Items/{id}', ['uses' => 'TicketingController@viewListItems', 'as' => 'viewListItems']);
Route::post('Ticketing/Items/Status/Add', ['uses' => 'TicketingController@addListItemsStatus' , 'as' => 'addListItemsStatus']);
Route::post('Ticketing/Schedule/Status', ['uses' => 'TicketingController@addScheduleTicket', 'as'=> 'addScheduleStatus']);
Route::get('Ticketing/Schedule/Process/{id}', ['uses' => 'TicketingController@processTicket', 'as' => 'processTicketStatus']);

//Resources

Route::resource('Schedule', 'ScheduleController');

// Ajax Controller Register Ajax

Route::get('viewOrganization/{id}', ['uses' => 'Ajax\RegisterAjax@viewOrganization' , 'as' => 'viewOrganization']);
Route::get('viewDivision/{id}', ['uses' => 'Ajax\RegisterAjax@viewDivision' , 'as' => 'viewDivision']);

// Ajax Controller Schedule Ajax

Route::get('viewDepartment/{id}', ['uses' => 'Ajax\ScheduleController@viewDepartment', 'as' => 'viewDepartment']);

// Main Controller Ajax

Route::get('Calendar/Place/{id}', ['uses' => 'Ajax\MainController@calendar_place', 'as' => 'calendar_place']);

// Google Account

Route::get('google', [ 'uses' => 'GoogleController@redirectToGoogle' , 'as' => 'redirect']);
Route::get('auth/google/callback', ['uses' => 'GoogleController@handleGoogleCallback' , 'as' => 'callback']);
