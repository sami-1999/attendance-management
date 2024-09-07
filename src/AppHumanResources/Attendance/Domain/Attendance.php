<?php

namespace AppHumanResources\Attendance\Domain;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendance'; 

    protected $fillable = ['employee_id', 'checkin', 'checkout', 'total_hours', 'attendance_fault_id'];

   
    protected $casts = [
        'employee_id' => 'integer',
    ];
    
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function attendanceFault()
    {
        return $this->belongsTo(AttendanceFault::class);
    }
}
