<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiPengambilan extends Model
{
    protected $table      = 'transaksi_pengambilan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['transaksi_masuk_id', 'tgl_ambil', 'user_creator', 'user_editor'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getAllTransactions()
    {
        $model = new TransaksiPengambilan();
        return $model
            ->select('transaksi_pengambilan.*, transaksi_masuk.nama')
            ->join('transaksi_masuk', 'transaksi_masuk.id = transaksi_pengambilan.transaksi_masuk_id');
    }

    public function searchTransaction($keyword)
    {
        $model = new TransaksiPengambilan();
        return $model
            ->select('transaksi_pengambilan.*, transaksi_masuk.nama')
            ->join('transaksi_masuk', 'transaksi_masuk.id = transaksi_pengambilan.transaksi_masuk_id')
            ->like('transaksi_masuk.nama', $keyword)
            ->orLike('transaksi_pengambilan.transaksi_masuk_id', $keyword);
    }
}
