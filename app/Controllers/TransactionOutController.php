<?php

namespace App\Controllers;

use App\Models\Pemasukan;
use App\Models\TransaksiMasuk;
use App\Models\TransaksiPengambilan;

class TransactionOutController extends BaseController
{
    public function __construct()
    {
        $this->TransaksiMasuk = new TransaksiMasuk();
        $this->TransaksiPengambilan = new TransaksiPengambilan();
        $this->Pemasukan = new Pemasukan();
    }

    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $pengambilan = $this->TransaksiPengambilan->searchTransaction($keyword);
            $totalRows = $this->TransaksiPengambilan->countRows($keyword);
        } else {
            $pengambilan = $this->TransaksiPengambilan->getAllTransactions();
            $totalRows = $this->TransaksiPengambilan->countRows();
        }
        $currentPage = $this->request->getVar('page');
        $data = [
            'title' => 'Transactions',
            'header' => 'Transaksi Pengambilan',
            'pengambilan' => $pengambilan->orderBy('transaksi_pengambilan.tgl_ambil', 'DESC')->paginate(5),
            'pager' => $pengambilan->pager,
            'currentPage' => $currentPage ? $currentPage : 1,
            'perPage' => 5,
            'totalRows' => $totalRows
        ];
        return view('transactions/out/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Transactions',
            'header' => 'Tambah Transaksi Pengambilan',
            'validation' => service('validation')
        ];
        return view('transactions/out/create', $data);
    }

    public function save()
    {
        if (!$this->validate('transaksiPengambilanRules')) {
            return redirect()->to('/transactions/transaksi-pengambilan/create')->withInput();
        }

        $transaksi_id = $this->request->getPost('transaksi_masuk_id');
        $cek_transaksi = $this->TransaksiMasuk->find($transaksi_id);
        if (!$cek_transaksi) {
            session()->setFlashdata('error', 'Transaksi tidak ditemukan!');
            return redirect()->to('/transactions/transaksi-pengambilan/create');
        } else {
            // insert data pengambilan
            $data = [
                'transaksi_masuk_id' => $transaksi_id,
                'tgl_ambil' => $this->request->getPost('tgl_ambil'),
                'user_creator' => strtoupper(session('name')),
            ];
            $this->TransaksiPengambilan->save($data);

            // auto insert pemasukan if lunas == 0
            if ($cek_transaksi['lunas'] == 0) {
                $pemasukan = [
                    'transaksi_masuk_id' => $transaksi_id,
                    'tanggal' => $this->request->getPost('tgl_ambil'),
                    'keterangan' => 'Pembayaran Transaksi',
                    'jumlah' => $cek_transaksi['total_harga']
                ];
                $this->Pemasukan->save($pemasukan);
            }

            // auto update status transaksi
            $this->TransaksiMasuk->update($transaksi_id, ['status' => 1]);

            session()->setFlashdata('success', 'Data berhasil disimpan!');
            return redirect()->to('/transactions/transaksi-pengambilan');
        }
    }

    public function delete($transaksiID)
    {
        // update status transaksi masuk
        $this->TransaksiMasuk->update($transaksiID, ['status' => 0]);
        // hapus pemasukan jika bukan transaksi lunas
        $transaksi_masuk = $this->TransaksiMasuk->find($transaksiID);
        if ($transaksi_masuk['lunas'] == 0) {
            $this->Pemasukan->where('transaksi_masuk_id', $transaksiID)->delete();
        }
        // hapus pengambilan
        $this->TransaksiPengambilan->where('transaksi_masuk_id', $transaksiID)->delete();

        session()->setFlashdata('success', 'Data berhasil dihapus!');
        return redirect()->to('/transactions/transaksi-pengambilan');
    }

    //--------------------------------------------------------------------

}
