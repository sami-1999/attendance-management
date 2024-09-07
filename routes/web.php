<?php
use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [AttendanceController::class, 'showAttendance'])->name('attendance');
Route::get('/find-array-duplicate-element', [AttendanceController::class, 'findArrayDuplicateElement'])->name('findArrayDuplicateElement');


Route::post('/attendance/upload', [AttendanceController::class, 'upload'])->name('attendance.upload');



