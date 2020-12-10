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

    public function countOutcomeReport($whereQuery = [])
    {
        $model = new Pengeluaran();
        $model->selectCount('id');

        if ($whereQuery !== null) {
            if (is_array($whereQuery)) {
                if (!empty($whereQuery)) {
                    foreach ($whereQuery as $key => $query) {
                        $model->where($query);
                    }
                }
            } else {
                $model->where($whereQuery);
            }
        }

        return $model->get()->getRow('id');
    }

    public function sumOutcome($whereQuery = [])
    {
        $model = new Pengeluaran();
        $model->selectSum('jumlah');

        if ($whereQuery !== null) {
            if (is_array($whereQuery)) {
                if (!empty($whereQuery)) {
                    foreach ($whereQuery as $key => $query) {
                        $model->where($query);
                    }
                }
            } else {
                $model->where($whereQuery);
            }
        }

        return $model->get()->getRow('jumlah');
    }
}
