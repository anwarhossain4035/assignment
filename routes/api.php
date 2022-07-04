<?php
use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/upload',[EmployeeController::class,'fileUpload'])->name('upload');
Route::get('/employee-list',[EmployeeController::class,'employeeList'])->name('index');
Route::get('/pdf',[EmployeeController::class,'generatePdf'])->name('pdf');
Route::post('/filter',[EmployeeController::class,'employeeList'])->name('filter');
