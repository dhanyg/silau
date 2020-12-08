<?php

namespace App\Controllers;

use App\Models\Item;
use App\Models\Layanan;
use App\Models\Pemasukan;
use App\Models\TransaksiMasuk;
use App\Models\TransaksiPengambilan;

class TransactionInController extends BaseController
{
    public function __construct()
    {
        $this->Layanan = new Layanan();
        $this->TransaksiMasuk = new TransaksiMasuk();
        $this->TransaksiPengambilan = new TransaksiPengambilan();
        $this->Item = new Item();
        $this->Pemasukan = new Pemasukan();
    }

    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        $currentPage = $this->request->getVar('page');
        if ($keyword) {
            $transaksi_masuk = $this->TransaksiMasuk->searchTransaction($keyword);
            $totalRows = $this->TransaksiMasuk->countRows($keyword);
        } else {
            $transaksi_masuk = $this->TransaksiMasuk->getAllTransactions();
            $totalRows = $this->TransaksiMasuk->countRows();
        }
        $data = [
            'title' => 'Transactions',
            'header' => 'Transaksi Masuk',
            'transaksi_masuk' => $transaksi_masuk->orderBy('transaksi_masuk.id', 'DESC')->paginate(5),
            'pager' => $transaksi_masuk->pager,
            'currentPage' => $currentPage ? $currentPage : 1,
            'perPage' => 5,
            'totalRows' => $totalRows
        ];
        return view('transactions/in/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Transactions',
            'header' => 'Tambah Transaksi Masuk',
            'validation' => service('validation'),
            'all_layanan' => $this->Layanan->findAll(),
        ];
        $max = $this->TransaksiMasuk->selectMax('id')->get()->getRowArray();
        $data['no_transaksi'] = $max['id'] ? $max['id'] + 1 : 1;
        return view('transactions/in/create', $data);
    }

    public function save()
    {
        if (!$this->validate('transaksiMasukRules')) {
            return redirect()->to('/transactions/transaksi-masuk/create')->withInput();
        }
        $data = [
            'nama' => strtoupper($this->request->getPost('nama')),
            'layanan_id' => $this->request->getPost('layanan_id'),
            'tgl_masuk' => $this->request->getPost('tgl_masuk'),
            'tgl_selesai' => $this->request->getPost('tgl_selesai'),
            'lunas' => $this->request->getPost('lunas'),
            'jumlah_item' => $this->request->getPost('jumlah_item'),
            'total_harga' => $this->request->getPost('total_harga'),
            'status' => 0,
            'user_creator' => strtoupper(session('name')),
            'user_editor' => null
        ];
        $items = [
            'item' => $this->request->getPost('item'),
            'jumlah' => $this->request->getPost('jumlah'),
            'satuan' => $this->request->getPost('satuan'),
            'harga' => $this->request->getPost('harga'),
        ];

        // insert to transaksi_masuk
        $this->TransaksiMasuk->save($data);
        $transaksi_id = $this->TransaksiMasuk->insertID();

        // insert to items
        $this->Item->insertItem($transaksi_id, $items);

        // insert to pemasukan if lunas == 1
        if ($data['lunas'] == 1) {
            $pemasukan = [
                'transaksi_masuk_id' => $transaksi_id,
                'tanggal' => $data['tgl_masuk'],
                'keterangan' => 'Pembayaran Lunas Transaksi',
                'jumlah' => $data['total_harga'],
            ];
            $this->Pemasukan->save($pemasukan);
        }

        session()->setFlashdata('success', 'Transaksi berhasil disimpan!');
        return redirect()->to('/transactions/transaksi-masuk');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Transactions',
            'header' => 'Edit Transaksi Masuk',
            'validation' => service('validation'),
            'transaksi' => $this->TransaksiMasuk->find($id),
            'all_layanan' => $this->Layanan->findAll(),
            'items' => $this->Item->where('transaksi_id', $id)->findAll()
        ];
        return view('transactions/in/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate('transaksiMasukRules')) {
            return redirect()->to('/transactions/transaksi-masuk/edit/' . $id)->withInput();
        }

        $data = [
            'id' => $id,
            'nama' => strtoupper($this->request->getPost('nama')),
            'layanan_id' => $this->request->getPost('layanan_id'),
            'tgl_masuk' => $this->request->getPost('tgl_masuk'),
            'tgl_selesai' => $this->request->getPost('tgl_selesai'),
            'lunas' => $this->request->getPost('lunas'),
            'jumlah_item' => $this->request->getPost('jumlah_item'),
            'total_harga' => $this->request->getPost('total_harga'),
            'user_editor' => strtoupper(session('name')),
        ];
        $items = [
            'item' => $this->request->getPost('item'),
            'jumlah' => $this->request->getPost('jumlah'),
            'satuan' => $this->request->getPost('satuan'),
            'harga' => $this->request->getPost('harga'),
        ];

        // insert to transaksi_masuk
        $this->TransaksiMasuk->save($data);
        $transaksi_id = $id;

        // delete items
        $this->Item->where('transaksi_id', $transaksi_id)->delete();
        // re-insert items
        $this->Item->insertItem($transaksi_id, $items);

        // update pemasukan
        $cek_pemasukan = $this->Pemasukan->where('transaksi_masuk_id', $transaksi_id)->first();
        if ($data['lunas'] == 1) {
            if (!$cek_pemasukan) {
                $pemasukan = [
                    'transaksi_masuk_id' => $transaksi_id,
                    'tanggal' => $data['tgl_masuk'],
                    'keterangan' => 'Pembayaran Lunas Transaksi',
                    'jumlah' => $data['total_harga'],
                ];
                $this->Pemasukan->save($pemasukan);
            }
        }
        if ($data['lunas'] == 0) {
            if ($cek_pemasukan) {
                $this->Pemasukan->where('transaksi_masuk_id', $transaksi_id)->delete();
            }
        }

        session()->setFlashdata('success', 'Transaksi berhasil diubah!');
        return redirect()->to('/transactions/transaksi-masuk/detail/' . $id);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Transactions',
            'header' => 'Detail Transaksi',
            'transaksi' => $this->TransaksiMasuk
                ->getTransactionDetail($id)
                ->first(),
            'items' => $this->Item->where('transaksi_id', $id)->findAll()

        ];
        return view('transactions/in/detail', $data);
    }

    public function delete($id)
    {
        // delete items
        $this->Item->where('transaksi_id', $id)->delete();
        // cek pemasukan
        $cek_pemasukan = $this->Pemasukan->where('transaksi_masuk_id', $id)->first();
        if ($cek_pemasukan) {
            $this->Pemasukan->where('transaksi_masuk_id', $id)->delete();
        }
        // cek pengambilan
        $cek_pengambilan = $this->TransaksiPengambilan->where('transaksi_masuk_id', $id)->first();
        if ($cek_pengambilan) {
            $this->TransaksiPengambilan->where('transaksi_masuk_id', $id)->delete();
        }
        // delete transaksi
        $this->TransaksiMasuk->delete($id);

        session()->setFlashdata('success', 'Transaksi berhasil dihapus!');
        return redirect()->to('/transactions/transaksi-masuk');
    }

    //--------------------------------------------------------------------

}
