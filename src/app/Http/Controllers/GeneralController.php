<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\BreakTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller
{
    public function getAttendance(){
        $date = Carbon::now()->format('Y-m-d');
        $user = Auth::user();
        $attendance = Attendance::where('date','=', $date)->where('user_id','=', $user->id)->first();
        return view('general.attendance_register', compact('attendance'));
    }

    public function getRequestList(){

        return view('general.request_list');
    }

    public function getAttendanceDetail(Request $request){
        $user = Auth::user();
        $attendance = Attendance::where('id','=', $request->id)->first();
        $breakTimes = BreakTime::where('attendance_id','=', $request->id)->orderBy('start_at', 'asc')->get();
    return view('general.attendance_detail', compact('user', 'attendance', 'breakTimes'));
    }
    

    public function postAttendanceClockIn(Request $request){
        $attendance = new Attendance();
        $attendance->user_id = $request->user()->id;
        $attendance->date = Carbon::now()->format('Y-m-d');
        $attendance->clock_in_at = Carbon::now()->format('H:i');
        $attendance->status = 'AttendanceAtWork';
        $attendance->save();
        return redirect('/attendance');
    }

    public function postAttendanceClockOut(Request $request){
        $date = Carbon::now()->format('Y-m-d');
        $attendance = Attendance::where('date','=', $date)->where('user_id','=', $request->user()->id)->first();
        $attendance->clock_out_at = Carbon::now()->format('H:i');
        $attendance->status = 'LeavingWork';
        $attendance->save();
        return redirect('/attendance');
    }

    public function postAttendanceBreakTimeStart(Request $request){
        $date = Carbon::now()->format('Y-m-d');
        $attendance = Attendance::where('date','=', $date)->where('user_id','=', $request->user()->id)->first();
        $attendance->status = 'DuringBreak';
        $attendance->save();
        $breakTime = new BreakTime();
        $breakTime->attendance_id = $request->id;
        $breakTime->start_at = Carbon::now()->format('H:i');
        // Log::debug($breakTimeStart);
        $breakTime->save();
        return redirect('/attendance');
    }

    public function postAttendanceBreakTimeEnd(Request $request){
        $date = Carbon::now()->format('Y-m-d');
        $attendance = Attendance::where('date','=', $date)->where('user_id','=', $request->user()->id)->first();
        $attendance->status = 'AttendanceAtWork';
        $attendance->save();
        $breakTime = BreakTime::where('attendance_id','=', $request->id)->orderBy('start_at', 'desc')->first();
        $breakTime->end_at = Carbon::now()->format('H:i');
        $breakTime->save();
        return redirect('/attendance');
    }


    public function getAttendanceList(){
        $date = Carbon::now()->format('Y-m');
        $user = Auth::user();
        // $breakTime = DB::table('attendances')->where('user_id','=', $user->id)->where('date','like', $date . '%')->orderBy('date', 'desc')->joinSub(
        //     BreakTime::select(DB::raw('attendance_id, timediff(end_at,start_at) as total_time')),'break_times', 'attendances.id', '=', 'break_times.attendance_id')->selectRaw("DATE_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(total_time))), '%H:%i') as total_break_time")->value('total_break_time');


        $attendances = DB::table('attendances')->where('user_id','=', $user->id)->where('date','like', $date . '%')->orderBy('date', 'desc')->joinSub(
            BreakTime::select(DB::raw('attendance_id, TIMEDIFF(end_at,start_at) as break_time')),'break_times', 'attendances.id', '=', 'break_times.attendance_id')->groupBy('attendance_id')->selectRaw("id, date, clock_in_at, clock_out_at,DATE_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(break_time))), '%H:%i') as total_break_time, DATE_FORMAT(TIMEDIFF(TIMEDIFF(clock_out_at,clock_in_at),SEC_TO_TIME(SUM(TIME_TO_SEC(break_time)))), '%H:%i') as total_time")->get();
        Log::debug($attendances);
        return view('general.attendance_list', compact('attendances'));
    }

}
