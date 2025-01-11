<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\AdminController;


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

Route::get('/login', function () { return view('general.login');});
Route::get('/register', function () { return view('general.register');});
Route::get('/admin/login', function () { return view('admin.login');});

// Route::group(['middleware' => ['role:admin']], function (){
//     Route::get('/admin/attendance/list', [AdminController::class, 'getAttendanceList']);
//     Route::get('/attendance/{id}', [AdminController::class, 'getAttendanceDetail'])->name('attendance.detail');
//     Route::post('/attendance/{id}', [AdminController::class, 'postAttendanceDetail'])->name('attendance.detail');
//     Route::get('/admin/staff/list', [AdminController::class, 'getStaffList']);
//     Route::get('/admin/attendance/staff/{id}', [AdminController::class, 'getStaffAttendanceList'])->name('attendance.staffList');
//     Route::get('/stamp_correction_request/list', [AdminController::class, 'getRequestList']);
//     Route::get('/stamp_correction_request/approve/{attendance_correct_request}', [AdminController::class, 'getApprove'])->name('approve.revice');
//     Route::post('/stamp_correction_request/approve/{attendance_correct_request}', [AdminController::class, 'postApprove'])->name('approve.revice');
// });

Route::group(['middleware' => ['role:editor']], function (){
    // Route::post('/login', [GeneralController::class, 'login']);
    // Route::post('/register', [GeneralController::class, 'register']);
    
    // Route::get('/attendance', [GeneralController::class, 'getAttendanceRegister']);
    // Route::get('/attendance', function () { return view('general.attendance_register');});
    Route::get('/attendance', [GeneralController::class, 'getAttendance']);
    Route::post('/attendance/clock_in', [GeneralController::class, 'postAttendanceClockIn']);
    Route::post('/attendance/clock_out', [GeneralController::class, 'postAttendanceClockOut']);
    Route::post('/attendance/break_time_start', [GeneralController::class, 'postAttendanceBreakTimeStart']);
    Route::post('/attendance/break_time_end', [GeneralController::class, 'postAttendanceBreakTimeEnd']);
    Route::get('/attendance/list', [GeneralController::class, 'getAttendanceList']);
    Route::get('/attendance/{id}', [GeneralController::class, 'getAttendanceDetail'])->name('attendance.detail');
    // Route::post('/attendance/{id}', [GeneralController::class, 'postAttendanceDetail'])->name('attendance.detail');
    Route::get('/stamp_correction_request/list', [GeneralController::class, 'getRequestList']);
});