<?php

namespace App\Imports;

use AppHumanResources\Attendance\Domain\Attendance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Carbon;

class AttendanceImport implements ToModel, WithHeadingRow  // Add WithHeadingRow concern
{
    /**
     * Prepare the data for each row in the model.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Skip rows where the employee_id is null or not numeric
        if (empty($row['employee_id']) || !is_numeric($row['employee_id'])) {
            return null;
        }

        // Convert 'N/A' to null for checkin and checkout fields
        $checkin = $row['checkin'] === 'N/A' ? null : $row['checkin'];
        $checkout = $row['checkout'] === 'N/A' ? null : $row['checkout'];

        // Check if datetime fields are valid
        if ($checkin && !$this->isValidDateTime($checkin)) {
            return null;
        }

        if ($checkout && !$this->isValidDateTime($checkout)) {
            return null;
        }

        return new Attendance([
            'employee_id' => (int) $row['employee_id'],
            'checkin' => $checkin ? Carbon::parse($checkin) : null,
            'checkout' => $checkout ? Carbon::parse($checkout) : null,
        ]);
    }

    /**
     * Validate the datetime format.
     *
     * @param string $datetime
     * @return bool
     */
    private function isValidDateTime($datetime)
    {
        return (bool) strtotime($datetime);
    }
}
