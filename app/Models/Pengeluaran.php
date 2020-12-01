<?php

namespace App\Models;

use CodeIgniter\Model;

class Pengeluaran extends Model
{
    protected $table      = 'pengeluaran';
    protected $primaryKey = 'id';
    protected $allowedFields = ['keterangan', 'tanggal', 'jumlah'];
}
