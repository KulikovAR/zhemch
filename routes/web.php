<?php

use Illuminate\Support\Facades\Auth;
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
Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('welcome');
    });


    Route::group(['middleware' => 'isadmin'], function () {
        // Танцоры
        Route::get('/dancer/list','App\Http\Controllers\DancersController@list')->name('dancers');
        Route::get('/dancer/dolg/{dancer}','App\Http\Controllers\DancersController@dolg')->name('dolg');
        Route::get('/dancer/create','App\Http\Controllers\DancersController@create')->name('dancercreate');
        Route::post('/dancer/createpost','App\Http\Controllers\DancersController@createPost')->name('dancercreatepost');
        Route::get('/dancer/update/{id}','App\Http\Controllers\DancersController@update')->name('dancerupdate');
        Route::post('/dancer/updatepost','App\Http\Controllers\DancersController@updatePost')->name('dancerupdatepost');
        Route::get('/dancer/delete/{id}','App\Http\Controllers\DancersController@delete')->name('dancerdelete');

        // Направления
        Route::get('/type/list','App\Http\Controllers\TypeController@list')->name('type');
        Route::get('/type/create','App\Http\Controllers\TypeController@create')->name('typecreate');
        Route::post('/type/createpost','App\Http\Controllers\TypeController@createPost')->name('typecreatepost');
        Route::get('/type/update/{id}','App\Http\Controllers\TypeController@update')->name('typeupdate');
        Route::post('/type/updatepost','App\Http\Controllers\TypeController@updatePost')->name('typeupdatepost');
        Route::get('/type/delete/{id}','App\Http\Controllers\TypeController@delete')->name('typedelete');

        // Абонемент
        Route::get('/sub/list','App\Http\Controllers\SubcribtionController@list')->name('sub');
        Route::get('/sub/create','App\Http\Controllers\SubcribtionController@create')->name('subcreate');
        Route::post('/sub/createpost','App\Http\Controllers\SubcribtionController@createPost')->name('subcreatepost');
        Route::get('/sub/update/{id}','App\Http\Controllers\SubcribtionController@update')->name('subupdate');
        Route::post('/sub/updatepost','App\Http\Controllers\SubcribtionController@updatePost')->name('subupdatepost');
        Route::get('/sub/delete/{id}','App\Http\Controllers\SubcribtionController@delete')->name('subdelete');


        // Расписание
        Route::get('/timetable/list/{room}','App\Http\Controllers\TimetableController@list')->name('timetable');
        Route::get('/timetable/create/{day}/{room}','App\Http\Controllers\TimetableController@create')->name('timetablecreate');
        Route::get('/timetable/update/{id}','App\Http\Controllers\TimetableController@update')->name('timetableupdate');
        Route::post('/timetable/updatepost','App\Http\Controllers\TimetableController@updatePost')->name('timetableupdatepost');
        Route::get('/timetable/delete/{id}','App\Http\Controllers\TimetableController@delete')->name('timetabledelete');

        // Группы
        Route::get('/group/list','App\Http\Controllers\GroupController@list')->name('group');
        Route::get('/group/create','App\Http\Controllers\GroupController@create')->name('groupcreate');
        Route::post('/group/createpost','App\Http\Controllers\GroupController@createPost')->name('groupcreatepost');
        Route::get('/group/update/{id}','App\Http\Controllers\GroupController@update')->name('groupupdate');
        Route::post('/group/updatepost','App\Http\Controllers\GroupController@updatePost')->name('groupupdatepost');
        Route::get('/group/delete/{id}','App\Http\Controllers\GroupController@delete')->name('groupdelete');


        Route::get('/trainer/list','App\Http\Controllers\TrainerController@list')->name('trainer');
        Route::get('/trainer/confirm/{id}','App\Http\Controllers\TrainerController@confirm')->name('trainerconfirm');
        Route::get('/trainer/update/{id}','App\Http\Controllers\TrainerController@update')->name('trainerupdate');
        Route::post('/trainer/update/post/','App\Http\Controllers\TrainerController@updatePost')->name('trainerupdatepost');
        Route::get('/trainer/balance/{id}','App\Http\Controllers\TrainerController@balance')->name('trainerbalance');
        Route::get('/trainer/delete/{id}','App\Http\Controllers\TrainerController@delete')->name('trainerdelete');
        Route::get('/journal/list','App\Http\Controllers\JournalController@list')->name('journal');
        Route::get('/journal/listAll','App\Http\Controllers\JournalController@listAll')->name('journalall');
        Route::get('/journal/update/{id}','App\Http\Controllers\JournalController@update')->name('journalupdate');
        Route::get('/journal/delete/{id}','App\Http\Controllers\JournalController@delete')->name('journaldelete');
        Route::post('/journal/update/post/','App\Http\Controllers\JournalController@updatePost')->name('journalupdatepost');


        Route::get('/payment/list/{group_id}','App\Http\Controllers\PaymentController@list')->name('payment');
        Route::get('/payment/delete/{id}','App\Http\Controllers\PaymentController@delete')->name('paymentdelete');

    });
    Route::group(['middleware' => 'istrainer'], function () {


        // Расписание
        Route::get('/timetable/user/list/{room}','App\Http\Controllers\TimetableController@userList')->name('usertimetable');
        Route::get('/timetable/user/create/{day}/{room}','App\Http\Controllers\TimetableController@userCreate')->name('timetableusercreate');
        // Танцоры
        Route::get('/dancer/userlist','App\Http\Controllers\DancersController@userlist')->name('userlist');


        // Журнал 
        Route::get('/journal/create/{id}','App\Http\Controllers\JournalController@create')->name('journalcreate');
        Route::post('/journal/create/post/','App\Http\Controllers\JournalController@createPost')->name('journalcreatepost');
        Route::post('/timetable/createpost','App\Http\Controllers\TimetableController@createPost')->name('timetablecreatepost');

        // Оплата
        Route::get('/payment/create/{id}','App\Http\Controllers\PaymentController@create')->name('paymentcreate');
        Route::post('/payment/create/post/','App\Http\Controllers\PaymentController@createPost')->name('paymentcreatepost');

    });
});

Route::get('/home', function()
{
    return view('home');
})->name('home');

Auth::routes();