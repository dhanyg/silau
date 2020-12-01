<?php

namespace App\Models;

use CodeIgniter\Model;

class Role extends Model
{
    protected $table      = 'roles';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'display_name'];
}
