<?php

namespace App\Controllers;

use App\Models\Pemasukan;

class CashflowInController extends BaseController
{
    public function __construct()
    {
        $this->Pemasukan = new Pemasukan();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page');
        $data = [
            'title' => 'Cash FLow',
            'header' => 'Pemasukan',
            'pemasukan' => $this->Pemasukan->orderBy('tanggal', 'DESC')->paginate(5),
            'pager' => $this->Pemasukan->pager,
            'currentPage' => $currentPage ? $currentPage : 1,
            'perPage' => 5,
            'totalRows' => $this->Pemasukan->countRows()
        ];
        return view('cashflow/in/index', $data);
    }

    //--------------------------------------------------------------------

}
