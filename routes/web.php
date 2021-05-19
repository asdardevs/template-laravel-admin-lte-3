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
    return view('welcome');
});

Auth::routes();



#all Akses role
Route::post('cek-user', 'Auth\RegisterController@cek_user');

Route::group(['middleware' => ['auth']], function () {
    # Admin, Operator
    Route::get('/beranda', 'HomeController@index')->name('home');

    Route::group(['middleware' => ['web',  'verified', 'roles']], function () {
        Route::group(['roles' => 'Admin'], function () {

            Route::resource('user', 'Admin\UserController');
            Route::resource('role', 'RoleController');
            Route::resource('menu', 'Menu\MenuController');
            Route::resource('sub-menu', 'Menu\SubMenuController');
            Route::resource('dosen', 'Admin\TeacherController');
            Route::get('create-dosen', 'Admin\TeacherController@buat_user');
            Route::resource('classroom', 'Admin\ClassroomController');
            Route::resource('fakultas', 'Admin\FacultyController');
            Route::resource('prodi', 'Admin\ProgramController');


            Route::get('upload', 'Admin\QuestionController@upload');
            Route::post('image/upload/store', 'Admin\QuestionController@fileStore');
        });
        Route::group(['roles' => 'Operator'], function () {
            Route::resource('kelas', 'Dosen\ClassroomController');
            Route::resource('dosen-pengumuman', 'Dosen\AnnouncementsController');
            // controller Meeting
            Route::get('kelas/pertemuan/{kode}', 'Dosen\MeetingController@index');
        });
    });
});
