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
            ->getAllTransactions()
            ->like('transaksi_masuk.nama', $keyword)
            ->orLike('transaksi_pengambilan.transaksi_masuk_id', $keyword);
    }

    public function countRows($keyword = null)
    {
        $model = new TransaksiPengambilan();
        if ($keyword != null) {
            return $model
                ->selectCount('transaksi_pengambilan.id')
                ->join('transaksi_masuk', 'transaksi_masuk.id = transaksi_pengambilan.transaksi_masuk_id')
                ->like('transaksi_masuk.nama', $keyword)
                ->orLike('transaksi_pengambilan.transaksi_masuk_id', $keyword)
                ->get()
                ->getRow('id');
        } else {
            return $model->selectCount('transaksi_pengambilan.id')->get()->getRow('id');
        }
    }

    public function countTransactionReport($whereQuery = [])
    {
        $model = new TransaksiPengambilan();
        $model
            ->selectCount('transaksi_pengambilan.id')
            ->join('transaksi_masuk', 'transaksi_masuk.id = transaksi_pengambilan.transaksi_masuk_id');
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
}
