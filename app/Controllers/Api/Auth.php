<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\FacultyModel;
use CodeIgniter\API\ResponseTrait;

class Auth extends BaseController
{
    use ResponseTrait;
    private FacultyModel $facultyModel;

    public function __construct()
    {
        $this->facultyModel = new FacultyModel();
    }

    public function postLogin()
    {
        $postData = $this->request->getJSON(true);
        if(!$postData['username'] || !$postData['password']) {
            return $this->failValidationErrors('Username and password are required');
        }

        $authenticatedUser = $this->facultyModel->checkUserByPassword($postData['username'], $postData['password']);
        if (!$authenticatedUser) {
            return $this->failUnauthorized('Invalid username or password');
        }

        return $this->respond([
            'status' => 'success',
            'message' => 'Authentication successful',
            'data' => $authenticatedUser,
        ]);
    }

    public function postUpdateCredentials($id = null)
    {
        $postData = $this->request->getJSON(true);
        
        // 1. Basic Validation
        if (!$id) {
            return $this->failValidationErrors('Faculty ID is required');
        }

        if (empty($postData['username']) || empty($postData['current_password'])) {
            return $this->failValidationErrors('Username and current password are required to verify changes.');
        }

        // 2. Fetch the Faculty Record
        $faculty = $this->facultyModel->find($id);
        if (!$faculty || $faculty['is_admin'] == 1) {
            return $this->failNotFound('Faculty member not found');
        }
        $existing = $this->facultyModel->where('username', $postData['username'])
                               ->where('faculty_id !=', $id)
                               ->first();
        if ($existing) {
            return $this->failResourceExists('That username is already taken by another faculty member.');
        }
        // 3. Verify Identity (Current Password Check)
        if (!password_verify($postData['current_password'], $faculty['password'])) {
            return $this->fail('Incorrect current password. Identity could not be verified.', 401);
        }

        // 4. Prepare Data for Update
        $updateData = [
            'username' => $postData['username']
        ];

        // Only hash and update the password if a NEW one was actually provided
        if (!empty($postData['new_password'])) {
            $updateData['password'] = password_hash($postData['new_password'], PASSWORD_DEFAULT);
        }

        // 5. Execute Update
        if ($this->facultyModel->update($id, $updateData)) {
            return $this->respond([
                'status' => 'success',
                'message' => 'Credentials updated successfully',
            ]);
        }

        return $this->fail('Failed to update credentials. Please try again.');
    }
}
