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

    public function getAllUsers()
    {
        $userModel = new User();
        return $userModel
            ->select('users.*, roles.display_name as role_name')
            ->join('roles', 'roles.id = users.role_id');
    }

    public function getUserDetail($userId)
    {
        $userModel = new User();
        return $userModel
            ->select('users.*, roles.display_name as role_name')
            ->join('roles', 'roles.id = users.role_id')
            ->where('users.id', $userId);
    }

    public function searchUser($keyword)
    {
        $userModel = new User();
        return $userModel
            ->select('users.*, roles.display_name as role_name')
            ->join('roles', 'roles.id = users.role_id')
            ->like('users.username', $keyword)
            ->orLike('users.display_name', $keyword);
    }
}
