<?php

namespace App\Models;

use CodeIgniter\Model;

class CurrentLocationModel extends Model
{
    protected $table            = 'current_locations';
    protected $primaryKey       = 'faculty_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['faculty_id', 'location_id'];

    public function getLatestScan($faculty_id)
    {

        return $this->db->table('current_locations')
            ->select('current_locations.*, locations.name as location_name, locations.building')
            ->join('locations', 'locations.location_id = current_locations.location_id')
            ->where('faculty_id', $faculty_id)
            ->orderBy('last_scanned', 'DESC')
            ->get()
            ->getFirstRow('array');
    }

    public function getRecentScan($faculty_id)
    {

        return $this->db->table('current_locations')
            ->select('current_locations.*, locations.name as location_name, locations.building')
            ->join('locations', 'locations.location_id = current_locations.location_id')
            ->where('faculty_id', $faculty_id)
            ->orderBy('last_scanned', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();
    }

    public function getAllCurrentLocations()
    {
        return $this->db->table('current_locations')
            ->select('current_locations.*, locations.name as location_name, locations.building, faculties.first_name, faculties.last_name')
            ->join('locations', 'locations.location_id = current_locations.location_id')
            ->join('faculties', 'faculties.faculty_id = current_locations.faculty_id')
            ->orderBy('last_scanned', 'DESC')
            ->get()
            ->getResultArray();
    }
}
