<?php
namespace AppHumanResources\Attendance\Domain;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendance';
    protected $fillable = ['employee_id', 'schedule_id', 'checkin', 'checkout'];

    public function employee()
    {
        return $this->belongsTo(\App\Models\Employee::class);
    }

    public function schedule()
    {
        return $this->belongsTo(\App\Models\Schedule::class);
    }
}
