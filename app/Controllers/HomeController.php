<?php

namespace App\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\TransaksiMasuk;
use App\Models\TransaksiPengambilan;
use App\Models\User;

class HomeController extends BaseController
{
    public function __construct()
    {
        $this->TransaksiMasuk = new TransaksiMasuk();
        $this->Pengambilan = new TransaksiPengambilan();
        $this->Pemasukan = new Pemasukan();
        $this->Pengeluaran = new Pengeluaran();
        $this->User = new User();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'header' => 'Dashboard',
            'total_transaksi' => $this->TransaksiMasuk->countAll(),
            'pengambilan' => $this->Pengambilan->countAll(),
            'pemasukan' => $this->Pemasukan->selectSum('jumlah')->get()->getRowArray(),
            'pengeluaran' => $this->Pengeluaran->selectSum('jumlah')->get()->getRowArray(),
            'user' => $this->User->countAll(),
            'transaksi_masuk' => $this->TransaksiMasuk
                ->getAllTransactions()
                ->orderBy('transaksi_masuk.id', 'Desc')
                ->findAll(3),
            'transaksi_pengambilan' => $this->Pengambilan
                ->getAllTransactions()
                ->orderBy('transaksi_pengambilan.tgl_ambil', 'Desc')
                ->findAll(3),
            'chart_transaksi_masuk' => $this->TransaksiMasuk->getCharts()->findAll(),
            'chart_pemasukan' => $this->Pemasukan->getCharts()->findAll()
        ];
        $data['saldo'] = $data['pemasukan']['jumlah'] - $data['pengeluaran']['jumlah'];
        return view('home/index', $data);
    }

    //--------------------------------------------------------------------

}
