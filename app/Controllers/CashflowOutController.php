<?php

namespace App\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;

class CashflowOutController extends BaseController
{
    public function __construct()
    {
        $this->Pengeluaran = new Pengeluaran();
    }

    public function index()
    {
        $keyword  = $this->request->getVar('keyword');
        if ($keyword) {
            $pengeluaran = $this->Pengeluaran->like('keterangan', $keyword);
            $totalRows = $this->Pengeluaran->countRows($keyword);
        } else {
            $pengeluaran = $this->Pengeluaran;
            $totalRows = $this->Pengeluaran->countRows();
        }
        $currentPage = $this->request->getVar('page');
        $data = [
            'title' => 'Cash FLow',
            'header' => 'Pengeluaran',
            'pengeluaran' => $pengeluaran->orderBy('tanggal', 'DESC')->paginate(5),
            'currentPage' => $currentPage ? $currentPage : 1,
            'pager' => $pengeluaran->pager,
            'perPage' => 5,
            'totalRows' => $totalRows
        ];
        return view('cashflow/out/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Cash Flow',
            'header' => 'Tambah Data Pengeluaran',
            'validation' => service('validation')
        ];
        return view('cashflow/out/create', $data);
    }

    public function save()
    {
        if (!$this->validate('pengeluaranRules')) {
            return redirect()->to('/cash-flow/pengeluaran/create')->withInput();
        }

        $data = [
            'keterangan' => $this->request->getPost('keterangan'),
            'tanggal' => $this->request->getPost('tanggal'),
            'jumlah' => $this->request->getPost('jumlah'),
        ];
        $this->Pengeluaran->save($data);

        session()->setFlashdata('success', 'Data berhasil disimpan!');
        return redirect()->to('/cash-flow/pengeluaran');
    }

    public function edit($pengeluaranID)
    {
        $data = [
            'title' => 'Cash Flow',
            'header' => 'Edit Data Pengeluaran',
            'validation' => service('validation'),
            'pengeluaran' => $this->Pengeluaran->find($pengeluaranID)
        ];
        return view('cashflow/out/edit', $data);
    }

    public function update($pengeluaranID)
    {
        if (!$this->validate('pengeluaranRules')) {
            return redirect()->to('/cash-flow/pengeluaran/edit/' . $pengeluaranID)->withInput();
        }

        $data = [
            'id' => $pengeluaranID,
            'keterangan' => $this->request->getPost('keterangan'),
            'tanggal' => $this->request->getPost('tanggal'),
            'jumlah' => $this->request->getPost('jumlah'),
        ];
        $this->Pengeluaran->save($data);

        session()->setFlashdata('success', 'Data berhasil diubah!');
        return redirect()->to('/cash-flow/pengeluaran');
    }

    public function delete($pengeluaranID)
    {
        $this->Pengeluaran->delete($pengeluaranID);
        session()->setFlashdata('success', 'Data berhasil diubah!');
        return redirect()->to('/cash-flow/pengeluaran');
    }

    //--------------------------------------------------------------------

}
