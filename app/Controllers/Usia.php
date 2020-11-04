<?php



namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsiaModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class Usia extends BaseController
{

    protected $UsiaModel;
    public function __construct()
    {
        $this->UsiaModel = new UsiaModel();
    }
    public function contoh()
    {

        $data = [
            'tittle' => 'Data Lansia',

            'isi' => 'Usia/v_contoh',

        ];
        echo view('layout/v_wrapper', $data);
    }

    public function jquery_master_contoh()
    {
        $listing = $this->UsiaModel->get_datatables_contoh();
        $jumlah_semua = $this->UsiaModel->count_all_contoh();
        $jumlah_filter = $this->UsiaModel->count_filtered_contoh();

        $data = array();
        $no = @$_POST['start'];

        foreach ($listing as $key) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<a href="' . site_url('Datamaster/delete/' . $key->id_mstr) . '" onclick="return confirm(\'Yakin....?\')" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i></a>
            <a href="' . site_url('Datamaster/detail/' . $key->id_mstr) . '" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>';
            $row[] = $key->nik;
            $row[] = $key->nkk;
            $row[] = $key->nama;
            $row[] = tanggal_indo($key->tgl_lahir);
            $row[] = hitung_umur($key->tgl_lahir);
            $row[] = $key->agama;
            $row[] = $key->jekel;
            $row[] = $key->pekerjaan;
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
}
