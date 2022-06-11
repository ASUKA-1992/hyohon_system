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
    return view('top');
});

// 会議一覧
Route::get('meeting', 'App\Http\Controllers\MeetingController@index')->name('meeting.index');
Route::get('meeting/create', 'App\Http\Controllers\MeetingController@create')->name('meeting.create');
Route::get('meeting/{id}', 'App\Http\Controllers\MeetingController@show')->name('meeting.show');
Route::post('meeting/store', 'App\Http\Controllers\MeetingController@store')->name('meeting.store');


// 管理画面
Route::get('admin', 'App\Http\Controllers\Admin\TopController@top')->name('admin.top');
// 役割
Route::get('admin/role', 'App\Http\Controllers\Admin\RoleController@index')->name('role.index');
Route::get('admin/role/create', 'App\Http\Controllers\Admin\RoleController@create');
Route::post('admin/role/store', 'App\Http\Controllers\Admin\RoleController@store');
Route::get('admin/role/edit/{id}', 'App\Http\Controllers\Admin\RoleController@edit')->name('role.edit');
Route::patch('admin/role/update/{id}', 'App\Http\Controllers\Admin\RoleController@update')->name('role.update');
Route::delete('admin/role/destroy/{id}', 'App\Http\Controllers\Admin\RoleController@destroy');
// アクション
Route::get('admin/action', 'App\Http\Controllers\Admin\ActionController@index')->name('action.index');
Route::get('admin/action/create', 'App\Http\Controllers\Admin\ActionController@create');
Route::post('admin/action/store', 'App\Http\Controllers\Admin\ActionController@store');
Route::get('admin/action/edit/{id}', 'App\Http\Controllers\Admin\ActionController@edit')->name('action.edit');
Route::patch('admin/action/update/{id}', 'App\Http\Controllers\Admin\ActionController@update')->name('action.update');
Route::delete('admin/action/destroy/{id}', 'App\Http\Controllers\Admin\ActionController@destroy');
// テーマ
Route::get('admin/theme', 'App\Http\Controllers\Admin\ThemeController@index')->name('theme.index');
Route::get('admin/theme/create', 'App\Http\Controllers\Admin\ThemeController@create');
Route::post('admin/theme/store', 'App\Http\Controllers\Admin\ThemeController@store');
Route::get('admin/theme/edit/{id}', 'App\Http\Controllers\Admin\ThemeController@edit')->name('theme.edit');
Route::patch('admin/theme/update/{id}', 'App\Http\Controllers\Admin\ThemeController@update')->name('theme.update');
Route::delete('admin/theme/destroy/{id}', 'App\Http\Controllers\Admin\ThemeController@destroy');