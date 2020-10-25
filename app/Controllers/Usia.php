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
    public function lansia()
    {

        $data = [
            'tittle' => 'Data Lansia',
            'db_mstr' => $this->UsiaModel->get_lansia(),
            'isi' => 'Usia/v_lansia',

        ];
        echo view('layout/v_wrapper', $data);
    }
}
