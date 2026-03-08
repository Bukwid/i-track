<?php

namespace App\Models;

use CodeIgniter\Model;

class FacultyModel extends Model
{
    protected $table            = 'faculties';
    protected $primaryKey       = '	faculty_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['first_name', 'last_name', 'username', 'password', 'is_admin'];

    public function createFaculty($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        return $this->insert($data);
    }

    public function getFacultyByUsername($username)
    {
        return $this->where('username', $username)->first();
    }

    public function checkUserByPassword($username, $password)
    {
        $faculty = $this->getFacultyByUsername($username);

        if ($faculty && password_verify($password, $faculty['password'])) {
            return $faculty;
        }
        return false;
    }
    
}
