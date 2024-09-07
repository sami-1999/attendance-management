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

    public function findArrayDuplicateElement($arr = [2, 3, 1, 2, 3]) {
        $frequencyMap = [];
        $duplicates = [];
    
        foreach ($arr as $num) {
            if (isset($frequencyMap[$num])) {
                $frequencyMap[$num]++;
            } else {
                $frequencyMap[$num] = 1;
            }
        }
    

        foreach ($frequencyMap as $num => $count) {
            if ($count > 1) {
                $duplicates[] = $num;
            }
        }
    
        return $duplicates;
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
