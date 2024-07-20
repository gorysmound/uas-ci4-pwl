<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransactionModel;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;

class PageController extends BaseController
{

    protected $transaksi;
    protected $validation;

    function __construct()
    {
        $this->transaksi = new TransactionModel();
    }
    public function index()
    {
        $transaksi = $this->transaksi->findAll();
        $data['transaksi'] = $transaksi;

        return view('v_transaksi', $data);
    }

    public function edit($id)
    {
        $rules = ['status' => 'numeric|required|max_length[1]|less_than[2]'];

        if ($this->validate($rules)) {
            $dataForm = [
                'status' => $this->request->getPost('status'),
            ];
        } else {
            session()->setFlashdata('failed', $this->validator->listErrors());
            return redirect()->back();
        }

        $this->transaksi->update($id, $dataForm);

        return redirect('transaksi')->with('success', 'Status Berhasil Diubah');
    }

    public function download()
    {
        $transaksi = $this->transaksi->findAll();

        $html = view('v_transaksiPDF', ['transaksi' => $transaksi]);

        $filename = date('y-m-d-H-i-s') . '-produk';

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // load HTML content
        $dompdf->loadHtml($html);

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'potrait');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename);
    }
}
