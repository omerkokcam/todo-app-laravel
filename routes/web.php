<?php

use App\Http\Controllers\ToDoController;
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


Route::group(['prefix'=>'/','as'=>'todo.'], function(){
    Route::get('/',[ToDoController::class,'index'])->name('index');
    Route::post('/create',[ToDoController::class,'create'])->name('create');
    Route::get('/fetch',[ToDoController::class,'fetch'])->name('fetch');
    Route::get('/get-excel-table',[ToDoController::class,'get_excel_table'])->name('get_excel_table');
    Route::get('/detail',[ToDoController::class,'detail'])->name('detail');
    Route::post('/update',[ToDoController::class,'update'])->name('update');
    Route::get('/change-is-done-status',[ToDoController::class,'change_is_done_status'])->name('change_is_done_status');
    Route::get('/delete',[ToDoController::class,'delete'])->name('delete');
});
