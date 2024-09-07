<?php

namespace AppHumanResources\Attendance\Application;

use AppHumanResources\Attendance\Domain\Attendance;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AttendanceImport;
use Carbon\Carbon;

class AttendanceService
{
    public function uploadAttendance($request)
    {
        // Handle file upload and data processing
        Excel::import(new AttendanceImport, $request->file('attendance_file'));
    }

    public function getAllAttendance()
    {
        // Fetch attendance with employee name and calculate total working hours
        return Attendance::with('employee')
            ->get()
            ->map(function ($attendance) {
                // Convert checkin and checkout to Carbon if not null
                $checkin = $attendance->checkin ? Carbon::parse($attendance->checkin) : null;
                $checkout = $attendance->checkout ? Carbon::parse($attendance->checkout) : null;
    
                // Format checkin and checkout times
                $checkinFormatted = $checkin ? $checkin->format('H:i') : 'N/A';
                $checkoutFormatted = $checkout ? $checkout->format('H:i') : 'N/A';
    
                // Calculate total hours if both checkin and checkout are present
                $totalHours = ($checkin && $checkout)
                    ? $checkin->diffInHours($checkout)
                    : 'N/A';
    
                return [
                    'name' => $attendance->employee->name,
                    'checkin' => $checkinFormatted,
                    'checkout' => $checkoutFormatted,
                    'total_hours' => $totalHours,
                ];
            });
    }

}
