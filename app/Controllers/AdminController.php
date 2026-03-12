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
        $checkCode = $this->locationModel->where('location_code', strtoupper($this->request->getPost('location_code')))->first();
        if($checkCode) {
            return redirect()->back()->withInput()->with('error', 'Location code "' . esc($this->request->getPost('location_code')) . '" already exists. Please use a different code.');
        }

        $checkname = $this->locationModel->where('name', $this->request->getPost('name'))
                                         ->where('building', $this->request->getPost('building'))
                                         ->first();
        if($checkname) {
            return redirect()->back()->withInput()->with('error', 'A room named "' . esc($this->request->getPost('name')) . '" already exists in ' . esc($this->request->getPost('building')) . '. Please choose a different name.');
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

    public function settingsPage()
    {
        $adminId = session()->get('faculty_id');
        $admin = $this->facultyModel->find($adminId);

        return view('admin/settings', [
            'page' => 'Settings',
            'admin' => $admin,
        ]);
    }

    public function updateUsername()
    {
        $adminId = session()->get('faculty_id');
        $admin = $this->facultyModel->find($adminId);

        $newUsername = $this->request->getPost('new_username');

        if (empty($newUsername)) {
            return redirect()->back()->with('error', 'Username cannot be empty.');
        }

        if ($newUsername === $admin['username']) {
            return redirect()->back()->with('error', 'New username is the same as the current one.');
        }

        $existing = $this->facultyModel->where('username', $newUsername)->where('faculty_id !=', $adminId)->first();
        if ($existing) {
            return redirect()->back()->withInput()->with('error', 'That username is already taken. Please choose a different one.');
        }

        $this->facultyModel->update($adminId, ['username' => $newUsername]);
        return redirect()->to('/settings')->with('success', 'Username updated successfully.');
    }

    public function updatePassword()
    {
        $adminId = session()->get('faculty_id');
        $admin = $this->facultyModel->find($adminId);

        $currentPassword = $this->request->getPost('current_password');
        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');

        if (!password_verify($currentPassword, $admin['password'])) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        if ($newPassword !== $confirmPassword) {
            return redirect()->back()->with('error', 'New password and confirmation do not match.');
        }

        if (strlen($newPassword) < 6) {
            return redirect()->back()->with('error', 'New password must be at least 6 characters.');
        }

        $this->facultyModel->update($adminId, ['password' => password_hash($newPassword, PASSWORD_DEFAULT)]);
        return redirect()->to('/settings')->with('success', 'Password updated successfully.');
    }
}
