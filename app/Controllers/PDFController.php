<?php

namespace App\Controllers;

use App\Models\Item;
use App\Models\Layanan;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\TransaksiMasuk;
use App\Models\TransaksiPengambilan;
use Mpdf\Mpdf;

class PDFController extends BaseController
{
    public function __construct()
    {
        $this->TransaksiMasuk = new TransaksiMasuk();
        $this->TransaksiPengambilan = new TransaksiPengambilan();
        $this->Layanan = new Layanan();
        $this->Item = new Item();
        $this->Pemasukan = new Pemasukan();
        $this->Pengeluaran = new Pengeluaran();
    }

    protected function generatePDF($html, $fileName, $paperSize = 'A4', $orientation = 'L')
    {
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];
        $defaulFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaulFontConfig['fontdata'];
        $mpdf = new Mpdf([
            'fontDir' => array_merge($fontDirs, [
                ROOTPATH . '/public/assets/fonts/poppins',
            ]),
            'fontdata' => $fontData + [
                'poppins' => [
                    'R' => 'Poppins-Regular.ttf',
                    'B' => 'Poppins-Bold.ttf'
                ]
            ],
            'default_font' => 'poppins',
            'format' => $paperSize,
            'orientation' => $orientation,
        ]);
        $mpdf->SetFooter('Page {PAGENO} of {nb}');
        $mpdf->WriteHTML($html);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output($fileName, 'I');
    }

    public function invoicePDF($transaksiID)
    {
        $data = [
            'title' => 'PDF Invoice',
            'data' => $this->TransaksiMasuk
                ->select('transaksi_masuk.*, layanan.nama as nama_layanan')
                ->join('layanan', 'layanan.id = transaksi_masuk.layanan_id')
                ->where('transaksi_masuk.id', $transaksiID)
                ->first(),
            'items' => $this->Item->where('transaksi_id', $transaksiID)->findAll()
        ];
        $html = view('pdf/invoice', $data);
        $fileName = 'invoice-' . $transaksiID . '.pdf';
        $this->generatePDF($html, $fileName, 'A5', 'P');
    }

    public function transaksiMasukPDF($dateStart, $dateEnd)
    {
        $data = [
            'title' => 'PDF Transaksi Masuk',
            'tanggal_awal' => $dateStart,
            'tanggal_akhir' => $dateEnd,
            'data' => $this->TransaksiMasuk
                ->select('transaksi_masuk.*, layanan.nama as nama_layanan')
                ->join('layanan', 'layanan.id = transaksi_masuk.layanan_id')
                ->where("transaksi_masuk.tgl_masuk BETWEEN '$dateStart' AND '$dateEnd'")
                ->orderBy('transaksi_masuk.tgl_masuk')
                ->findAll(),
            'jumlah_transaksi' => $this->TransaksiMasuk->countTransactionReport(["tgl_masuk BETWEEN '$dateStart' AND '$dateEnd'"]),
            'transaksi_selesai' => $this->TransaksiMasuk->countTransactionReport(["tgl_masuk BETWEEN '$dateStart' AND '$dateEnd'", "transaksi_masuk.status = 1"]),
            'transaksi_laundry' => $this->TransaksiMasuk->countTransactionReport(["tgl_masuk BETWEEN '$dateStart' AND '$dateEnd'", "layanan.nama LIKE '%laundry%'"]),
            'transaksi_setrika' => $this->TransaksiMasuk->countTransactionReport(["tgl_masuk BETWEEN '$dateStart' AND '$dateEnd'", "layanan.nama LIKE '%setrika%'"]),
        ];
        $html = view('pdf/report-transaksi-masuk', $data);
        $fileName = 'transaksi-masuk-' . $dateStart . '-sampai-' . $dateEnd . '.pdf';
        $this->generatePDF($html, $fileName);
    }

    public function transaksiPengambilanPDF($dateStart, $dateEnd)
    {
        $data = [
            'title' => 'PDF Transaksi Pengambilan',
            'tanggal_awal' => $dateStart,
            'tanggal_akhir' => $dateEnd,
            'data' => $this->TransaksiPengambilan
                ->select('transaksi_pengambilan.*, transaksi_masuk.nama')
                ->join('transaksi_masuk', 'transaksi_masuk.id = transaksi_pengambilan.transaksi_masuk_id')
                ->where("transaksi_pengambilan.tgl_ambil BETWEEN '$dateStart' AND '$dateEnd'")
                ->orderBy('transaksi_pengambilan.tgl_ambil')
                ->findAll(),
            'jumlah_pengambilan' => $this->TransaksiPengambilan->countTransactionReport("tgl_ambil BETWEEN '$dateStart' AND '$dateEnd'"),
        ];
        $html = view('pdf/report-transaksi-pengambilan', $data);
        $fileName = 'transaksi-pengambilan-' . $dateStart . '-sampai-' . $dateEnd . '.pdf';
        $this->generatePDF($html, $fileName);
    }

    public function pemasukanPDF($dateStart, $dateEnd)
    {
        $data = [
            'title' => 'PDF Pemasukan',
            'tanggal_awal' => $dateStart,
            'tanggal_akhir' => $dateEnd,
            'data' => $this->Pemasukan
                ->select('pemasukan.*, transaksi_masuk.nama')
                ->join('transaksi_masuk', 'transaksi_masuk.id = pemasukan.transaksi_masuk_id')
                ->where("pemasukan.tanggal BETWEEN '$dateStart' AND '$dateEnd'")
                ->orderBy('tanggal')
                ->findAll(),
            'total_pemasukan' => $this->Pemasukan->sumIncome("tanggal BETWEEN '$dateStart' AND '$dateEnd'"),
            'jumlah_transaksi' => $this->Pemasukan->countRows("tanggal BETWEEN '$dateStart' AND '$dateEnd'"),
            'pembayaran_lunas' => $this->Pemasukan->countRows(["tanggal BETWEEN '$dateStart' AND '$dateEnd'", 'transaksi_masuk.lunas = 1']),
            'pembayaran_nonlunas' => $this->Pemasukan->countRows(["tanggal BETWEEN '$dateStart' AND '$dateEnd'", 'transaksi_masuk.lunas = 0'])
        ];
        $html = view('pdf/report-pemasukan', $data);
        $fileName = 'pemasukan-' . $dateStart . '-sampai-' . $dateEnd . '.pdf';
        $this->generatePDF($html, $fileName);
    }

    public function pengeluaranPDF($dateStart, $dateEnd)
    {
        $data = [
            'title' => 'PDF Pengeluaran',
            'tanggal_awal' => $dateStart,
            'tanggal_akhir' => $dateEnd,
            'data' => $this->Pengeluaran
                ->where("tanggal BETWEEN '$dateStart' AND '$dateEnd'")
                ->orderBy('tanggal')
                ->findAll(),
            'total_pengeluaran' => $this->Pengeluaran->sumOutcome("tanggal BETWEEN '$dateStart' AND '$dateEnd'"),
            'jumlah_data' => $this->Pengeluaran->countOutcomeReport("tanggal BETWEEN '$dateStart' AND '$dateEnd'"),
        ];
        // dd($data['data']);
        $html = view('pdf/report-pengeluaran', $data);
        $fileName = 'pengeluaran-' . $dateStart . '-sampai-' . $dateEnd . '.pdf';
        $this->generatePDF($html, $fileName);
    }
    //--------------------------------------------------------------------

}
