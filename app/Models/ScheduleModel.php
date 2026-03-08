<?php

namespace App\Models;

use CodeIgniter\Model;

class ScheduleModel extends Model
{
    protected $table            = 'schedules';
    protected $primaryKey       = 'schedule_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['faculty_id', 'location_id', 'day_of_week', 'start_time', 'end_time', 'subject_name', 'location_id'];

    public function getFacultySchedule($faculty_id) 
    {
        return $this->db->table('schedules')
            ->select('schedules.*, locations.name as location_name, locations.building')
            ->join('locations', 'locations.location_id = schedules.location_id')
            ->where('faculty_id', $faculty_id)
            // Sort by Day of Week first, then by Time
            ->orderBy("FIELD(day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")
            ->orderBy('start_time', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function getFacultyScheduleByDay($faculty_id, $day_of_week) 
    {
        return $this->db->table('schedules')
            ->select('schedules.*, locations.name as location_name, locations.building')
            ->join('locations', 'locations.location_id = schedules.location_id')
            ->where('faculty_id', $faculty_id)
            ->where('day_of_week', $day_of_week)
            ->orderBy('start_time', 'ASC')
            ->get()
            ->getResultArray();
    }
}
