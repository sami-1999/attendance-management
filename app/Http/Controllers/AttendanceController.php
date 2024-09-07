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

    public function upload(Request $request)
    {
        // Upload Excel file and process it
        $this->attendanceService->uploadAttendance($request);
        
        return redirect()->back()->with('success', 'Attendance uploaded successfully.');
    }

    public function showAttendance()
    {
        // Get attendance data
        $attendanceData = $this->attendanceService->getAllAttendance();
        
        return view('attendence', compact('attendanceData'));
    }
}
