<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiMasuk extends Model
{
    protected $table      = 'transaksi_masuk';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'layanan_id', 'tgl_masuk', 'tgl_selesai', 'total_harga', 'jumlah_item', 'lunas', 'status', 'user_creator', 'user_editor'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


    public function getAllTransactions()
    {
        $model = new TransaksiMasuk();
        return $model
            ->select('transaksi_masuk.*, layanan.nama as nama_layanan')
            ->join('layanan', 'layanan.id = transaksi_masuk.layanan_id');
    }

    public function getTransactionDetail($id)
    {
        $model = new TransaksiMasuk();
        return $model
            ->select('transaksi_masuk.*, layanan.nama as nama_layanan')
            ->join('layanan', 'layanan.id = transaksi_masuk.layanan_id')
            ->where('transaksi_masuk.id', $id);
    }

    public function searchTransaction($keyword)
    {
        $model = new TransaksiMasuk();
        return $model
            ->select('transaksi_masuk.*, layanan.nama as nama_layanan')
            ->join('layanan', 'layanan.id = transaksi_masuk.layanan_id')
            ->like('transaksi_masuk.nama', $keyword)
            ->orLike('transaksi_masuk.id', $keyword);
    }

    public function getCharts()
    {
        $model = new TransaksiMasuk();
        return $model->select("DATE_FORMAT(tgl_masuk, '%d %b %Y') AS tanggal, COUNT(*) as jumlah")
            ->where("tgl_masuk BETWEEN DATE(NOW()) - INTERVAL 6 DAY AND DATE(NOW())")
            ->groupBy("tgl_masuk")
            ->orderBy("tgl_masuk");
    }
}
