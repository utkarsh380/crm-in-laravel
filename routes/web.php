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

Route::get('/', function () {
   // return view('welcome');
 return view('admin.dashboard');
});

Auth::routes();

Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');



Route::get('leads', function(){
    return view('index');
  });
  
  // Route::get('leads/list', 'leadcrud\LeadController@index')->name('leads.list');

Route::post('leads/add','leadcrud\LeadController@add')->name('leads.add');

Route::resource('leads', 'leadcrud\LeadController');