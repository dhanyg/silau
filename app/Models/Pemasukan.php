<?php

namespace App\Models;

use CodeIgniter\Model;

class Pemasukan extends Model
{
    protected $table      = 'pemasukan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['transaksi_masuk_id', 'tanggal', 'keterangan', 'jumlah'];


    public function getAllIncomes()
    {
        $model = new Pemasukan();
        return $model
            ->select('pemasukan.*, transaksi_masuk.nama')
            ->join('transaksi_masuk', 'transaksi_masuk.id = pemasukan.transaksi_masuk_id');
    }

    public function countRows($whereQuery = [])
    {
        $model = new Pemasukan();
        $model
            ->selectCount('pemasukan.id')
            ->join('transaksi_masuk', 'transaksi_masuk.id = pemasukan.transaksi_masuk_id');

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

    public function sumIncome($whereQuery = [])
    {
        $model = new Pemasukan();
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

    public function getCharts()
    {
        $model = new Pemasukan();
        return $model->select("DATE_FORMAT(tanggal, '%d %b %Y') as tanggal, SUM(jumlah) as jumlah")
            ->where("tanggal BETWEEN DATE(NOW()) - INTERVAL 6 DAY AND DATE(NOW())")
            ->groupBy("tanggal")
            ->orderBy("tanggal");
    }
}
