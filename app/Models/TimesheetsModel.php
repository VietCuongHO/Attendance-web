<?php

namespace App\Models;

use Database\Factories\TimesheetsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TimesheetsModel extends Model
{
    use HasFactory;
    protected $table = 'timesheets';

    protected $fillable = [
        'id',
        'employee_id',
        'timekeeper_id',
        'timekeeping_at',
        'face_image',
        'status',
        'note',
        'created_at',
        'created_user',
        'updated_at',
        'updated_user'
    ];



    protected static function newFactory()
    {
        return TimesheetsFactory::new();
    }

    public function selectAttendances($condition = null)
    {
        if ($condition == null) return [];
        $result = DB::table($this->table)->join('timekeepers', 'timekeepers.id', '=', $this->table.'.timekeeper_id')
        ->join('offices', 'offices.id', '=', 'timekeepers.office_id')
        ->join('employees', 'employees.id', '=', $this->table.'.employee_id')
        ->select('employees.id', 'employees.first_name', 'employees.last_name', 'office_name',
            $this->table.'.timekeeper_id', 'timekeeping_at')
        ->orderByDesc($this->table.'.id');

        if (isset($condition['office'])) {
            $result = $result->where('offices.id', $condition['office']);
        }
        if (isset($condition['from'])) {
            $result = $result->where('timekeeping_at', '>=', $condition['from']);
        }
        if (isset($condition['to'])) {
            $result = $result->where('timekeeping_at', '<=', $condition['to'].' 23:59:59');
        }
        if (isset($condition['status'])) {
            $result = $result->where($this->table.'.status', $condition['status']);
        }

        return $result;
    }

    public function getAttendances($condition = null)
    {
        $timesheet = $this->selectAttendances($condition);
        return $timesheet == [] ? [] : $timesheet->get();
    }

    public function getTimesheetsByEmployeeId($condition = null)
    {
        //dd($condition);
        if ($condition == null) return [];
        $result = DB::table($this->table)
        //
        ->select('employee_id', 'timekeeper_id', 'timekeeping_at', 'face_image', 'status', DB::raw('date(timekeeping_at) as date'), DB::raw('MIN(time(timekeeping_at)) as check_in'), DB::raw('MAX(time(timekeeping_at)) as check_out'))
        ->orderByDesc('date')
        ->orderByDesc($this->table.'.employee_id');

        if (isset($condition['id'])) {
            if (is_array($condition['id'])) {
                $result = $result->where(function($query) use ($condition){
                    foreach ($condition['id'] as $value) {
                        $query->orWhere($this->table.'.employee_id', $value);
                    }
                });
            }
            else $result = $result->where($this->table.'.employee_id', $condition['id']);
        }

        if (isset($condition['from'])) {
            $result = $result->where('timekeeping_at', '>=', $condition['from']);
        }
        if (isset($condition['to'])) {
            $result = $result->where('timekeeping_at', '<=', $condition['to'].' 23:59:59');
        }
        if (isset($condition['status'])) {
            $result = $result->where($this->table.'.status', $condition['status']);
        }
        $result = $result->groupByRaw('date(timekeeping_at)');
        return $result == [] ? [] : $result->get();
    }

    public function pagination($condition = [], $page = 1, $perPage = 50)
    {
        return $this->selectAttendances($condition)->paginate($perPage, '*', 'page', $page);
    }

    public function saveAttendance($data = null)
    {
        if ($data == null) return;
        DB::table($this->table)->insert([
            'employee_id' => $data['employee_id'],
            'timekeeper_id' => $data['timekeeper_id'],
            'timekeeping_at' => Carbon::now(),
            'face_image' => $data['face_image'],
            'status' => $data['status'],
            'created_user' => $data['employee_id'],
            'updated_user' => $data['employee_id'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
