<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use SimpleSoftwareIO\QrCode\Generator;

use App\Models\FacultyModel;
use App\Models\LocationModel;
use App\Models\ScheduleModel;
use App\Models\CurrentLocationModel;

class AdminController extends BaseController
{
    private FacultyModel $facultyModel;
    private LocationModel $locationModel;
    private ScheduleModel $scheduleModel;
    private CurrentLocationModel $currentLocationModel;
    
    public function __construct()
    {
        $this->facultyModel = new FacultyModel();
        $this->locationModel = new LocationModel();
        $this->scheduleModel = new ScheduleModel();
        $this->currentLocationModel = new CurrentLocationModel();
    }

    public function index()
    {
        return view('admin/dashboard', [
            'page' => 'Dashboard',
            'facultyCount' => $this->facultyModel->where('is_admin', 0)->countAllResults(),
            'locationCount' => $this->locationModel->countAll(),
            'currentLocations' => $this->currentLocationModel->getAllCurrentLocations()
        ]);
    }

    public function faculty()
    {
        return view('admin/faculty', [
            'page' => 'Faculty',
            'facultyList' => $this->facultyModel->where('is_admin', 0)->findAll(),
        ]);
    }

    public function addFacultyPage()
    {
        return view('admin/addFaculty', [
            'page' => 'Add Faculty',
        ]);
    }

    public function addFaculty()
    {
        $checkUsername = $this->facultyModel->getFacultyByUsername($this->request->getPost('username'));
        $checkName = $this->facultyModel->where('first_name', $this->request->getPost('first_name'))->where('last_name', $this->request->getPost('last_name'))->first();
        if($checkUsername || $checkName) {
            return redirect()->back()->withInput()->with('error', 'Username or name already exists. Please choose a different one.');
        }
        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'is_admin' => 0,
        ];

        $this->facultyModel->insert($data);
        return redirect()->to('/faculty')->with('success', 'Faculty member added successfully.');
    }

    public function deleteFaculty($facultyId)
    {;
        $delete = $this->facultyModel->delete($facultyId);
        if($delete) {
            session()->setFlashdata('success', 'Faculty member deleted successfully.');
            return redirect()->to('/faculty');
        } else {
            session()->setFlashdata('error', 'Failed to delete faculty member. Please try again.');
            return redirect()->to('/faculty');
        }
    }

    public function location()
    {
        return view('admin/location', [
            'page' => 'Location',
            'locationList' => $this->locationModel->findAll(),
        ]);
    }

    public function addLocationPage()
    {
        return view('admin/addLocation', [
            'page' => 'Add Location',
        ]);
    }

    public function addLocation()
    {
        $checkname = $this->locationModel->where('name', $this->request->getPost('name'))->first();
        $checkCode = $this->locationModel->where('location_code', strtoupper($this->request->getPost('location_code')))->first();
        if($checkname || $checkCode) {
            return redirect()->back()->withInput()->with('error', 'Location name or code already exists. Please choose a different one.');
        }
        $data = [
            'location_code' => strtoupper($this->request->getPost('location_code')),
            'name' => $this->request->getPost('name'),
            'building' => $this->request->getPost('building'),
        ];

        $this->locationModel->insert($data);
        return redirect()->to('/location')->with('success', 'Location added successfully.');
    }

    public function getLocationQRCode($locationId)
    {
        $location = $this->locationModel->find($locationId);
        if (!$location) {
            return redirect()->to('/location')->with('error', 'Location not found.');
        }

        $qrcode = new Generator();

        $qrImage = $qrcode->size(200)->format('png')->generate($location['location_code']);

        $fileName = $location['location_code'] . '_qrcode.png';

        // Build the response manually to avoid RFC 7230 header issues
        return $this->response
            ->setHeader('Content-Type', 'image/png')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $fileName . '"')
            ->setBody($qrImage);
    }

    public function deleteLocation($locationId)
    {
        $delete = $this->locationModel->delete($locationId);
        if($delete) {
            session()->setFlashdata('success', 'Location deleted successfully.');
            return redirect()->to('/location');
        } else {
            session()->setFlashdata('error', 'Failed to delete location. Please try again.');
            return redirect()->to('/location');
        }
    }

    public function facultySchedule($facultyId)
    {
        $faculty = $this->facultyModel->find($facultyId);
        $schedules = $this->scheduleModel->getFacultySchedule($facultyId);
        if(!$faculty) {
            return redirect()->to('/faculty')->with('error', 'Faculty member not found.');
        }
        return view('admin/facultySchedule', [
            'page' => 'Faculty',
            'faculty' => $faculty,
            'schedules' => $schedules,
        ]);
    }

    public function addSchedulePage($facultyId)
    {
        return view('admin/addSchedule', [
            'page' => 'Add Schedule',
            'faculty_id' => $facultyId,
            'locations' => $this->locationModel->findAll(),
        ]);
    }

    public function addSchedule()
    {
        $faculty_id   = $this->request->getPost('faculty_id');
        $day_of_week  = $this->request->getPost('day_of_week');
        $start_time   = $this->request->getPost('start_time');
        $end_time     = $this->request->getPost('end_time');
        $location_id  = $this->request->getPost('location_id');
        $subject_name = $this->request->getPost('subject_name');

        // 1. Validation Logic: Check for Overlap
        // A conflict exists if: (ExistingStart < NewEnd) AND (ExistingEnd > NewStart)
        $conflict = $this->scheduleModel
            ->where('day_of_week', $day_of_week)
            ->where('location_id', $location_id)
            ->groupStart()
                ->where('start_time <', $end_time)
                ->where('end_time >', $start_time)
            ->groupEnd()
            ->first();

        if ($conflict) {
            return redirect()->back()
                ->withInput()
                ->with('error', "Conflict! This room is already occupied by another faculty at this time.");
        }

        // 2. No conflict found, proceed with insert
        $data = [
            'faculty_id'   => $faculty_id,
            'day_of_week'  => $day_of_week,
            'start_time'   => $start_time,
            'end_time'     => $end_time,
            'subject_name' => $subject_name,
            'location_id'  => $location_id,
        ];

        if ($this->scheduleModel->insert($data)) {
            return redirect()->to('/faculty/schedule/' . $faculty_id)
                            ->with('success', 'Schedule added successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to save schedule.');
        }
    }

    public function deleteSchedule($scheduleId)
    {
        $schedule = $this->scheduleModel->find($scheduleId);
        if (!$schedule) {
            return redirect()->back()->with('error', 'Schedule not found.');
        }

        if ($this->scheduleModel->delete($scheduleId)) {
            return redirect()->to('/faculty/schedule/' . $schedule['faculty_id'])
                            ->with('success', 'Schedule deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete schedule. Please try again.');
        }
    }
}
