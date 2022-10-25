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

Route::get('/', 'App\Http\Controllers\TopController@top')->name('top');
Route::get('message/{id}', 'App\Http\Controllers\TopController@message')->name('message');

//参加者系
Route::get('{meeting_id}/participant', 'App\Http\Controllers\ParticipantController@index')->name('participant.index');
Route::get('{meeting_id}/input_name', 'App\Http\Controllers\ParticipantController@input_name')->name('participant.input_name');
Route::post('{meeting_id}/input_name_store', 'App\Http\Controllers\ParticipantController@input_name_store')->name('participant.input_name_store');
Route::get('participant/{id}', 'App\Http\Controllers\ParticipantController@show')->name('participant.show');
Route::get('participant/{id}/meeting1_select', 'App\Http\Controllers\ParticipantController@meeting1_select')->name('participant.meeting1_select');
Route::get('participant/{id}/meeting1_finish', 'App\Http\Controllers\ParticipantController@meeting1_finish')->name('participant.meeting1_finish');
Route::get('participant/{id}/meeting2_select', 'App\Http\Controllers\ParticipantController@meeting2_select')->name('participant.meeting2_select');
Route::get('participant/{id}/meeting2_finish', 'App\Http\Controllers\ParticipantController@meeting2_finish')->name('participant.meeting2_finish');
Route::get('participant/{id}/meeting21_finish', 'App\Http\Controllers\ParticipantController@meeting21_finish')->name('participant.meeting21_finish');
Route::get('participant/{id}/meeting2_select', 'App\Http\Controllers\ParticipantController@meeting2_select')->name('participant.meeting2_select');

Route::get('participant/{id}/meeting_title_open', 'App\Http\Controllers\ParticipantController@meeting_title_open')->name('participant.meeting_title_open');
Route::get('participant/{id}/role_open', 'App\Http\Controllers\ParticipantController@role_open')->name('participant.role_open');
Route::get('participant/{id}/action_open', 'App\Http\Controllers\ParticipantController@action_open')->name('participant.action_open');
Route::get('participant/{id}/status_change/{new_status}', 'App\Http\Controllers\ParticipantController@status_change')->name('participant.status_change');

// 会議系
Route::get('meeting', 'App\Http\Controllers\MeetingController@index')->name('meeting.index');
Route::get('select_meeting', 'App\Http\Controllers\MeetingController@select_meeting')->name('meeting.select_meeting');
Route::get('meeting/create', 'App\Http\Controllers\MeetingController@create')->name('meeting.create');
Route::get('meeting/{id}', 'App\Http\Controllers\MeetingController@show')->name('meeting.show');
Route::post('meeting/store', 'App\Http\Controllers\MeetingController@store')->name('meeting.store');
Route::delete('meeting/destroy/{id}', 'App\Http\Controllers\MeetingController@destroy');
Route::get('meeting/comment/{id}', 'App\Http\Controllers\MeetingController@comment')->name('meeting.comment');
Route::post('meeting/comment/{id}', 'App\Http\Controllers\MeetingController@comment_store')->name('meeting.comment');

// 管理画面
Route::get('admin', 'App\Http\Controllers\Admin\TopController@top')->name('admin.top');

// 管理者ログイン
Route::get('admin/login', 'App\Http\Controllers\Admin\TopController@login')->name('admin.login');
Route::post('admin/login', 'App\Http\Controllers\Admin\TopController@login_store')->name('admin.login_store');
Route::post('admin/logout', 'App\Http\Controllers\Admin\TopController@logout')->name('admin.logout');

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

// Explode(グラレベ用)
Route::get('admin/explode', 'App\Http\Controllers\Admin\ExplodeController@index')->name('explode.index');
Route::get('admin/explode/create', 'App\Http\Controllers\Admin\ExplodeController@create')->name('explode.create');
Route::get('admin/explode/{id}', 'App\Http\Controllers\Admin\ExplodeController@show')->name('explode.show');
Route::post('admin/explode/store', 'App\Http\Controllers\Admin\ExplodeController@store')->name('explode.store');
Route::get('admin/explode/edit/{id}', 'App\Http\Controllers\Admin\ExplodeController@edit')->name('explode.edit');
Route::patch('admin/explode/update/{id}', 'App\Http\Controllers\Admin\ExplodeController@update')->name('explode.update');
Route::delete('admin/explode/destroy/{id}', 'App\Http\Controllers\Admin\ExplodeController@destroy');