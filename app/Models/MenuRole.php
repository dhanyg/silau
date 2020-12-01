<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuRole extends Model
{
    protected $table      = 'menu_roles';
    protected $primaryKey = 'id';
    protected $allowedFields = ['menu_id', 'role_id'];
}
