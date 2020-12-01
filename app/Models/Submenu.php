<?php

namespace App\Models;

use CodeIgniter\Model;

class Submenu extends Model
{
    protected $table      = 'submenu';
    protected $primaryKey = 'id';
    protected $allowedFields = ['menu_id', 'name', 'display_name', 'url', 'is_active'];
}
