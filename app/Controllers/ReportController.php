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
                ->where("tgl_masuk BETWEEN '$dari_tanggal' AND '$sampai_tanggal'");
            $jumlah_transaksi = $this->TransaksiMasuk->countTransactionReport(["tgl_masuk BETWEEN '$dari_tanggal' AND '$sampai_tanggal'"]);
            $transaksi_selesai = $this->TransaksiMasuk->countTransactionReport(["tgl_masuk BETWEEN '$dari_tanggal' AND '$sampai_tanggal'", "transaksi_masuk.status = 1"]);
            $transaksi_laundry = $this->TransaksiMasuk->countTransactionReport(["tgl_masuk BETWEEN '$dari_tanggal' AND '$sampai_tanggal'", "layanan.nama LIKE '%laundry%'"]);
            $transaksi_setrika = $this->TransaksiMasuk->countTransactionReport(["tgl_masuk BETWEEN '$dari_tanggal' AND '$sampai_tanggal'", "layanan.nama LIKE '%setrika%'"]);
        } else {
            $header = 'Laporan Transaksi Masuk';
            $transaksi_masuk = $this->TransaksiMasuk->getAllTransactions();
            $jumlah_transaksi = $this->TransaksiMasuk->countTransactionReport();
            $transaksi_selesai = $this->TransaksiMasuk->countTransactionReport("transaksi_masuk.status = 1");
            $transaksi_laundry = $this->TransaksiMasuk->countTransactionReport("layanan.nama LIKE '%laundry%'");
            $transaksi_setrika = $this->TransaksiMasuk->countTransactionReport("layanan.nama LIKE '%setrika%'");
        }
        $data = [
            'title' => 'Reports',
            'header' => $header,
            'transaksi_masuk' => $transaksi_masuk->orderBy('transaksi_masuk.id')->paginate(5),
            'pager' => $transaksi_masuk->pager,
            'currentPage' => $currentPage ? $currentPage : 1,
            'perPage' => 5,
            'count_jumlah_transaksi' => $jumlah_transaksi,
            'count_transaksi_selesai' => $transaksi_selesai,
            'count_transaksi_laundry' => $transaksi_laundry,
            'count_transaksi_setrika' => $transaksi_setrika,
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
                ->where("tgl_ambil BETWEEN '$dari_tanggal' AND '$sampai_tanggal'");
            $jumlah_pengambilan = $this->TransaksiPengambilan->countTransactionReport("tgl_ambil BETWEEN '$dari_tanggal' AND '$sampai_tanggal'");
        } else {
            $header = 'Laporan Transaksi Pengambilan';
            $pengambilan = $this->TransaksiPengambilan->getAllTransactions();
            $jumlah_pengambilan = $this->TransaksiPengambilan->countTransactionReport();
        }
        $data = [
            'title' => 'Reports',
            'header' => $header,
            'pengambilan' => $pengambilan->orderBy('transaksi_pengambilan.tgl_ambil')->paginate(5),
            'pager' => $pengambilan->pager,
            'currentPage' => $currentPage ? $currentPage : 1,
            'perPage' => 5,
            'count_jumlah_pengambilan' => $jumlah_pengambilan,
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
                ->where("tanggal BETWEEN '$dari_tanggal' AND '$sampai_tanggal'");
            $total_pemasukan = $this->Pemasukan->sumIncome("tanggal BETWEEN '$dari_tanggal' AND '$sampai_tanggal'");
            $jumlah_transaksi = $this->Pemasukan->countRows("tanggal BETWEEN '$dari_tanggal' AND '$sampai_tanggal'");
            $pembayaran_lunas = $this->Pemasukan->countRows(["tanggal BETWEEN '$dari_tanggal' AND '$sampai_tanggal'", 'transaksi_masuk.lunas = 1']);
            $pembayaran_nonlunas = $this->Pemasukan->countRows(["tanggal BETWEEN '$dari_tanggal' AND '$sampai_tanggal'", 'transaksi_masuk.lunas = 0']);
        } else {
            $header = 'Laporan Pemasukan';
            $pemasukan = $this->Pemasukan->getAllIncomes();
            $total_pemasukan = $this->Pemasukan->sumIncome();
            $jumlah_transaksi = $this->Pemasukan->countRows();
            $pembayaran_lunas = $this->Pemasukan->countRows('transaksi_masuk.lunas = 1');
            $pembayaran_nonlunas = $this->Pemasukan->countRows('transaksi_masuk.lunas = 0');
        }
        $data = [
            'title' => 'Reports',
            'header' => $header,
            'pemasukan' => $pemasukan->orderBy('tanggal')->paginate(5),
            'pager' => $pemasukan->pager,
            'currentPage' => $currentPage ? $currentPage : 1,
            'perPage' => 5,
            'total_pemasukan' => $total_pemasukan,
            'count_jumlah_transaksi' => $jumlah_transaksi,
            'count_pembayaran_lunas' => $pembayaran_lunas,
            'count_pembayaran_nonlunas' => $pembayaran_nonlunas,
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
            $pengeluaran = $this->Pengeluaran->where("tanggal BETWEEN '$dari_tanggal' AND '$sampai_tanggal'");
            $total_pengeluaran = $this->Pengeluaran->sumOutcome("tanggal BETWEEN '$dari_tanggal' AND '$sampai_tanggal'");
            $jumlah_data = $this->Pengeluaran->countOutcomeReport("tanggal BETWEEN '$dari_tanggal' AND '$sampai_tanggal'");
        } else {
            $header = 'Laporan Pengeluaran';
            $pengeluaran = $this->Pengeluaran;
            $total_pengeluaran = $this->Pengeluaran->sumOutcome();
            $jumlah_data = $this->Pengeluaran->countOutcomeReport();
        }
        $data = [
            'title' => 'Reports',
            'header' => $header,
            'pengeluaran' => $pengeluaran->orderBy('tanggal')->paginate(5),
            'pager' => $pengeluaran->pager,
            'currentPage' => $currentPage ? $currentPage : 1,
            'perPage' => 5,
            'total_pengeluaran' => $total_pengeluaran,
            'count_jumlah_data' => $jumlah_data,
        ];
        return view('reports/pengeluaran', $data);
    }

    //--------------------------------------------------------------------

}
