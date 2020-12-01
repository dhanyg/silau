<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['role_id', 'username', 'display_name', 'email', 'phone', 'password'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getAllUser()
    {
        $userModel = new User();
        return $userModel->select('users.id, users.display_name as user_name, roles.display_name as role_name')
            ->join('roles', 'roles.id = users.role_id')
            ->orderBy('users.display_name', 'ASC');
    }

    public function getUserDetail($userId)
    {
        $userModel = new User();
        return $userModel->select('users.*, roles.display_name as role_name')
            ->join('roles', 'roles.id = users.role_id')
            ->where('users.id', $userId);
    }
}
