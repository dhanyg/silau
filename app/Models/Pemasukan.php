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

    public function getCharts()
    {
        $model = new Pemasukan();
        return $model->select("DATE_FORMAT(tanggal, '%d %b %Y') as tanggal, SUM(jumlah) as jumlah")
            ->where("tanggal BETWEEN DATE(NOW()) - INTERVAL 6 DAY AND DATE(NOW())")
            ->groupBy("tanggal")
            ->orderBy("tanggal");
    }
}
