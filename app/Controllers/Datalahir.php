<?php



namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LahirModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class Datalahir extends BaseController
{

    protected $LahirModel;
    public function __construct()
    {
        $this->LahirModel = new LahirModel();
    }

    public function index()
    {

        $data = [
            'tittle' => 'Kelahiran',
            'isi' => 'Sirkulasi/v_klhrn',

        ];
        echo view('layout/v_wrapper', $data);
    }

    public function lahir2020()
    {

        $data = [
            'tittle' => 'Kelahiran 2020',
            'db_mstr' =>  $this->LahirModel->get_2020(),
            'isi' => 'Sirkulasi/v_lahir2020',

        ];
        echo view('layout/v_wrapper', $data);
    }

    public function save()
    {

        $data = [
            'nik' => $this->request->getPost('nik'),
            'nkk' => $this->request->getPost('nkk'),
            'nama' => $this->request->getPost('nama'),
            'tmp_lahir' => $this->request->getPost('tmp_lahir'),
            'tgl_lahir' => $this->request->getPost('tgl_lahir'),
            'kenagarian' => $this->request->getPost('kenagarian'),
            'jorong' => $this->request->getPost('jorong'),
            'agama' => $this->request->getPost('agama'),
            'id_hub' => $this->request->getPost('id_hub'),
            'stts_kwn' => $this->request->getPost('stts_kwn'),
            'jekel' => $this->request->getPost('jekel'),
            'nama_ayah' => $this->request->getPost('nama_ayah'),
            'nama_ibu' => $this->request->getPost('nama_ibu'),
            'stts_hidup' => $this->request->getPost('stts_hidup'),
            'pekerjaan' => $this->request->getPost('pekerjaan')
        ];
        $this->LahirModel->insert_mstr($data);
        session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        return redirect()->to(base_url('Datalahir/lahir2020'));
    }
    public function delete($id_mstr)

    {
        $this->LahirModel->delete_mstr($id_mstr);
        session()->setFlashdata('success', 'Data Berhasil Dihapus');
        return redirect()->to(base_url('Datalahir/lahir2020'));
    }
}
