<?php

namespace AppHumanResources\Attendance\Application;

use AppHumanResources\Attendance\Domain\Attendance;

class AttendanceService
{
    public function calculateTotalHours($checkin, $checkout)
    {
        return $checkout->diffInHours($checkin);
    }

    public function getAttendanceInfo($employeeId)
    {
        return Attendance::where('employee_id', $employeeId)->get();
    }
}
