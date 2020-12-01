<?php

namespace App\Models;

use CodeIgniter\Model;

class Layanan extends Model
{
    protected $table      = 'layanan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama'];
}
