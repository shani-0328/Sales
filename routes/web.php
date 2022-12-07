<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

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
    return view('index');


});

Route::get('employee',[EmployeeController::class,'index'])->name('employees.index');
Route::get('empvw',[EmployeeController::class,'show'])->name('emp_dtls_vw');
Route::get('emp_dtls_ed/{$id}',[EmployeeController::class,'edit'])->name('emp_dtls_ed');
Route::get('emp_dtls_dl',[EmployeeController::class,'delete'])->name('emp_dtls_dl');
Route::post('emp_dtls_store',[EmployeeController::class,'store'])->name('employees.store');
