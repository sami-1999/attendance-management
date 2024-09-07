<?php

namespace App\Http\Controllers;

use AppHumanResources\Attendance\Application\AttendanceService;
use AppHumanResources\Attendance\Domain\Attendance;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Imports\AttendanceImport;

class AttendanceController extends Controller
{
    protected $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function showAttendance()
    {
        $attendances = Attendance::with('employee')->get();
        return view('attendence', compact('attendances'));
    }

    public function uploadAttendance(Request $request)
    {
        $request->validate([
            'attendance_file' => 'required|file|mimes:csv,txt',
        ]);

        Excel::import(new AttendanceImport, $request->file('attendance_file'));

        return redirect()->back()->with('success', 'Attendance data imported successfully!');
    }
}
