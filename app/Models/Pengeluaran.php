<?php

namespace App\Models;

use CodeIgniter\Model;

class Pengeluaran extends Model
{
    protected $table      = 'pengeluaran';
    protected $primaryKey = 'id';
    protected $allowedFields = ['keterangan', 'tanggal', 'jumlah'];

    public function countRows($keyword = null)
    {
        $model = new Pengeluaran();
        if ($keyword != null) {
            return $model
                ->selectCount('id')
                ->like('keterangan', $keyword)
                ->get()
                ->getRow('id');
        } else {
            return $model->selectCount('id')->get()->getRow('id');
        }
    }
}
