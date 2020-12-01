<?php

namespace App\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\TransaksiMasuk;
use App\Models\TransaksiPengambilan;

class ReportController extends BaseController
{
    public function __construct()
    {
        $this->TransaksiMasuk = new TransaksiMasuk();
        $this->TransaksiPengambilan = new TransaksiPengambilan();
        $this->Pemasukan = new Pemasukan();
        $this->Pengeluaran = new Pengeluaran();
    }

    public function indexTransaksiMasuk()
    {
        $currentPage = $this->request->getVar('page');
        if ($this->request->getVar('dari_tanggal')) {
            $dari_tanggal = $this->request->getVar('dari_tanggal');
            $sampai_tanggal = $this->request->getVar('sampai_tanggal');
            $header = 'Laporan Transaksi ' . date('d M Y', strtotime($dari_tanggal)) . ' - ' . date('d M Y', strtotime($sampai_tanggal));
            $transaksi_masuk = $this->TransaksiMasuk
                ->getAllTransactions()
                ->where("tgl_masuk BETWEEN '$dari_tanggal' AND '$sampai_tanggal'")
                ->orderBy('transaksi_masuk.id');
        } else {
            $header = 'Laporan Transaksi Masuk';
            $transaksi_masuk = $this->TransaksiMasuk
                ->getAllTransactions()
                ->orderBy('transaksi_masuk.id', 'DESC');
        }
        $data = [
            'title' => 'Reports',
            'header' => $header,
            'transaksi_masuk' => $transaksi_masuk->paginate(5),
            'pager' => $transaksi_masuk->pager,
            'currentPage' => $currentPage ? $currentPage : 1,
            'perPage' => 5
        ];
        return view('reports/transaksi-masuk', $data);
    }

    public function indexTransaksiPengambilan()
    {
        $currentPage = $this->request->getVar('page');
        if ($this->request->getVar('dari_tanggal')) {
            $dari_tanggal = $this->request->getVar('dari_tanggal');
            $sampai_tanggal = $this->request->getVar('sampai_tanggal');
            $header = 'Laporan Pengambilan ' . date('d M Y', strtotime($dari_tanggal)) . ' - ' . date('d M Y', strtotime($sampai_tanggal));
            $pengambilan = $this->TransaksiPengambilan
                ->getAllTransactions()
                ->where("tgl_ambil BETWEEN '$dari_tanggal' AND '$sampai_tanggal'")
                ->orderBy('transaksi_pengambilan.tgl_ambil');
        } else {
            $header = 'Laporan Transaksi Pengambilan';
            $pengambilan = $this->TransaksiPengambilan
                ->getAllTransactions()
                ->orderBy('transaksi_pengambilan.tgl_ambil', 'DESC');
        }
        $data = [
            'title' => 'Reports',
            'header' => $header,
            'pengambilan' => $pengambilan->paginate(5),
            'pager' => $pengambilan->pager,
            'currentPage' => $currentPage ? $currentPage : 1,
            'perPage' => 5
        ];
        return view('reports/transaksi-pengambilan', $data);
    }

    public function indexPemasukan()
    {
        $currentPage = $this->request->getVar('page');
        if ($this->request->getVar('dari_tanggal')) {
            $dari_tanggal = $this->request->getVar('dari_tanggal');
            $sampai_tanggal = $this->request->getVar('sampai_tanggal');
            $header = 'Laporan Pemasukan ' . date('d M Y', strtotime($dari_tanggal)) . ' - ' . date('d M Y', strtotime($sampai_tanggal));
            $pemasukan = $this->Pemasukan
                ->getAllIncomes()
                ->where("tanggal BETWEEN '$dari_tanggal' AND '$sampai_tanggal'")
                ->orderBy('tanggal');
        } else {
            $header = 'Laporan Pemasukan';
            $pemasukan = $this->Pemasukan
                ->getAllIncomes()
                ->orderBy('tanggal', 'DESC');
        }
        $data = [
            'title' => 'Reports',
            'header' => $header,
            'pemasukan' => $pemasukan->paginate(5),
            'pager' => $pemasukan->pager,
            'currentPage' => $currentPage ? $currentPage : 1,
            'perPage' => 5
        ];
        return view('reports/pemasukan', $data);
    }

    public function indexPengeluaran()
    {
        $currentPage = $this->request->getVar('page');
        if ($this->request->getVar('dari_tanggal')) {
            $dari_tanggal = $this->request->getVar('dari_tanggal');
            $sampai_tanggal = $this->request->getVar('sampai_tanggal');
            $header = 'Laporan Pengeluaran ' . date('d M Y', strtotime($dari_tanggal)) . ' - ' . date('d M Y', strtotime($sampai_tanggal));
            $pengeluaran = $this->Pengeluaran
                ->where("tanggal BETWEEN '$dari_tanggal' AND '$sampai_tanggal'")
                ->orderBy('tanggal');
        } else {
            $header = 'Laporan Pengeluaran';
            $pengeluaran = $this->Pengeluaran->orderBy('tanggal', 'DESC');
        }
        $data = [
            'title' => 'Reports',
            'header' => $header,
            'pengeluaran' => $pengeluaran->paginate(5),
            'pager' => $pengeluaran->pager,
            'currentPage' => $currentPage ? $currentPage : 1,
            'perPage' => 5
        ];
        return view('reports/pengeluaran', $data);
    }

    //--------------------------------------------------------------------

}
