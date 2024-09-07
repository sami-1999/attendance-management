<?php

namespace App\Imports;

use AppHumanResources\Attendance\Domain\Attendance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class AttendanceImport implements ToModel
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Attendance([
            'employee_id' => (int) $row[0],
            'checkin'     => $row[1],
            'checkout'    => $row[2],
            'total_hours' => $row[3],
        ]);
    }
}
