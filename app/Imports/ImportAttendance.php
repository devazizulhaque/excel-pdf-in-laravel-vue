<?php

namespace App\Imports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportAttendance implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Attendance([
            'employee_id' => $row[3],
            'employee_name' => $row[4],
            'month' => $row[0],
            'date' => $row[1],
            'day' => $row[2],
            'department' => $row[5],
            'first_in_time' => $row[6],
            'last_out_time' => $row[7],
            'hours_of_work' => $row[8]
        ]);
    }
}
