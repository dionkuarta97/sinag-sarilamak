<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\KkModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class Datakk extends BaseController
{
    protected $KkModel;
    public function __construct()
    {
        $this->KkModel = new KkModel();
    }
    public function index()
    {

        $data = [
            'tittle' => 'Kartu Keluarga',
            'isi' => 'Datapenduduk/v_kk',

        ];
        echo view('layout/v_wrapper', $data);
    }

    public function jquery_master()
    {
        $listing = $this->KkModel->get_datatables();
        $jumlah_semua = $this->KkModel->count_all();
        $jumlah_filter = $this->KkModel->count_filtered();


        $data = array();
        $no = @$_POST['start'];

        foreach ($listing as $key) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<a href="' . site_url('Datakk/detail/' . $key->nkk) . '" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>';
            $row[] = $key->nkk;
            $row[] = $key->nama;
            $row[] = $key->hubungan;
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsFiltered" => $jumlah_filter->jml,
            "recordsTotal" => $jumlah_semua->jml,
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }
    public function detail($nkk)
    {

        $data = [
            'tittle' => 'Detail Keluarga',
            'db_kk' => $this->KkModel->detail_kk($nkk),
            'isi' => 'Datapenduduk/v_detailkk',

        ];
        echo view('layout/v_wrapper', $data);
    }

    public function excel()
    {
        $data['db_kk'] =  $this->KkModel->get_kk();


        $spreadsheet = new Spreadsheet;

        $spreadsheet->getProperties()->setCreator("Dion Kuarta");
        $spreadsheet->getProperties()->setLastModifiedBy("Dion Kuarta");

        $spreadsheet->getProperties()->setTitle("Data KK");
        $spreadsheet->getActiveSheetIndex(0);



        $spreadsheet->getActiveSheet()->setCellValue('A1', 'NO');
        $spreadsheet->getActiveSheet()->setCellValue('B1', 'NKK');
        $spreadsheet->getActiveSheet()->setCellValue('C1', 'NAMA');
        $spreadsheet->getActiveSheet()->setCellValue('D1', 'HUBUNGAN');


        $baris = 2;
        $no = 1;

        foreach ($data['db_kk'] as $mstr) {

            $spreadsheet->getActiveSheet()->setCellValue('A' . $baris, $no++);
            $spreadsheet->getActiveSheet()->setCellValueExplicit('B' . $baris, $mstr['nkk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $baris, $mstr['nama']);
            $spreadsheet->getActiveSheet()->setCellValue('D' . $baris, $mstr['hubungan']);


            $baris++;
        }



        $spreadsheet->getActiveSheet()->setTitle("Data KK");
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Data_KK.Xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);

        $writer->save('php://output');

        exit;
    }
}
