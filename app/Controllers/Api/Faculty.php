<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\FacultyModel;
use App\Models\CurrentLocationModel;
use App\Models\ScheduleModel;
use App\Models\LocationModel;

class Faculty extends BaseController
{

    use ResponseTrait;
    private FacultyModel $facultyModel;
    private CurrentLocationModel $currentLocationModel;
    private ScheduleModel $scheduleModel;
    private LocationModel $locationModel;

    public function __construct()
    {
        $this->facultyModel = new FacultyModel();
        $this->currentLocationModel = new CurrentLocationModel();
        $this->scheduleModel = new ScheduleModel();
        $this->locationModel = new LocationModel();
    }

    public function getList()
    {
        $faculties = $this->facultyModel->where('is_admin', 0)->findAll();
        return $this->respond([
            'status' => 'success',
            'data' => $faculties,
        ]);
    }

    public function getSearch($name)
    {
        $faculties = $this->facultyModel->like('first_name', $name)->orLike('last_name', $name)->where('is_admin', 0)->findAll();
        return $this->respond([
            'status' => 'success',
            'data' => $faculties,
        ]);
    }

    public function getLatestScan($id = null)
    {
        if(!$id) {
            return $this->failValidationErrors('Faculty ID is required');
        }

        $checkFaculty = $this->facultyModel->find($id);
        if(!$checkFaculty || $checkFaculty['is_admin'] == 1) {
            return $this->failNotFound('Faculty member not found');
        }
        $latestScan = $this->currentLocationModel->getLatestScan($id);
        if (!$latestScan) {
            return $this->failNotFound('No scan records found for this faculty member');
        }

        return $this->respond([
            'status' => 'success',
            'data' => $latestScan,
        ]);
    }

    public function getRecentScans($id = null)
    {
        if(!$id) {
            return $this->failValidationErrors('Faculty ID is required');
        }

        $checkFaculty = $this->facultyModel->find($id);
        if(!$checkFaculty || $checkFaculty['is_admin'] == 1) {
            return $this->failNotFound('Faculty member not found');
        }
        $recentScans = $this->currentLocationModel->getRecentScan($id);
        if (!$recentScans) {
            return $this->failNotFound('No scan records found for this faculty member');
        }

        return $this->respond([
            'status' => 'success',
            'data' => $recentScans,
        ]);
    }

    public function getFacultySchedule($id = null)
    {
        if(!$id) {
            return $this->failValidationErrors('Faculty ID is required');
        }

        $checkFaculty = $this->facultyModel->find($id);
        if(!$checkFaculty || $checkFaculty['is_admin'] == 1) {
            return $this->failNotFound('Faculty member not found');
        }

        $schedule = $this->scheduleModel->getFacultySchedule($id);
        return $this->respond([
            'status' => 'success',
            'data' => $schedule,
        ]);
    }

    public function getFacultyScheduleByDay($id = null, $day_of_week = null)
    {
        if(!$id || !$day_of_week) {
            return $this->failValidationErrors('Faculty ID and Day of Week are required');
        }

        $checkFaculty = $this->facultyModel->find($id);
        if(!$checkFaculty || $checkFaculty['is_admin'] == 1) {
            return $this->failNotFound('Faculty member not found');
        }

        $schedule = $this->scheduleModel->getFacultyScheduleByDay($id, $day_of_week);
        return $this->respond([
            'status' => 'success',
            'data' => $schedule,
        ]);
    }

    public function getScanLocation($id = null, $locationCode = null)
    {
        if(!$id || !$locationCode) {
            return $this->failValidationErrors('Faculty ID and Location Code are required');
        }

        $locationFiltered = strtolower($locationCode);

        $checkFaculty = $this->facultyModel->find($id);
        if(!$checkFaculty || $checkFaculty['is_admin'] == 1) {
            return $this->failNotFound('Faculty member not found');
        }

        $location = $this->locationModel->where('location_code', $locationFiltered)->first();
        if (!$location) {
            return $this->failNotFound('Location not found');
        }

        $scan = $this->currentLocationModel->insert([
            'faculty_id' => $id,
            'location_id' => $location['location_id']
        ]);
        if (!$scan) {
            return $this->failServerError('Failed to record scan');
        }

        return $this->respond([
            'status' => 'success',
            'message' => 'Scan recorded successfully'
        ]);
    }
}
