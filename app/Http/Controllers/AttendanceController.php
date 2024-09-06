<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    
    public function uploadAttendance(Request $request)
    {
    Excel::import(new AttendanceImport, $request->file('attendance_file'));
    return redirect()->back()->with('success', 'Attendance data imported successfully!');
    }


    public function showAttendance()
{
    $attendances = Attendance::with('employee')->get();
    return view('attendance', compact('attendances'));
}


}
