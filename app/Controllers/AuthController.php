<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\FacultyModel;

class AuthController extends BaseController
{
    private FacultyModel $facultyModel;
    
    public function __construct()
    {
        $this->facultyModel = new FacultyModel();
    }
    public function loginPage()
    {
        return view('login');
    }

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $faculty = $this->facultyModel->checkUserByPassword($username, $password);

        if ($faculty) {
            if($faculty['is_admin'] == 1) {
                session()->set('is_logged_in', true);
                session()->set('faculty_id', $faculty['faculty_id']);
                return redirect()->to('/dashboard');
            }
            return redirect()->back()->withInput()->with('error', 'You do not have admin access');
        } else {
            return redirect()->back()->withInput()->with('error', 'Invalid username or password');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

}
