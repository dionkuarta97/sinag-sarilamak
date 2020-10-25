<?php



namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MasukModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class Masuk extends BaseController
{

    protected $MasukModel;
    public function __construct()
    {
        $this->MasukModel = new MasukModel();
    }

    public function index()
    {

        $data = [
            'tittle' => 'Masuk',
            'isi' => 'Sirkulasi/v_msk',

        ];
        echo view('layout/v_wrapper', $data);
    }
    public function Masuk2020()
    {

        $data = [
            'tittle' => 'Masuk 2020',
            'db_mstr' =>  $this->MasukModel->get_2020(),
            'isi' => 'Sirkulasi/v_Masuk2020',

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
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'id_hub' => $this->request->getPost('id_hub'),
            'stts_kwn' => $this->request->getPost('stts_kwn'),
            'jekel' => $this->request->getPost('jekel'),
            'nama_ayah' => $this->request->getPost('nama_ayah'),
            'nama_ibu' => $this->request->getPost('nama_ibu'),
            'stts_hidup' => $this->request->getPost('stts_hidup'),
            'tgl_mmp' => $this->request->getPost('tgl_mmp'),
            'alamat_astj' => $this->request->getPost('alamat_astj'),
            'keg_astj' => $this->request->getPost('keg_astj'),
            'pelapor' => $this->request->getPost('pelapor')
        ];
        $this->MasukModel->insert_mstr($data);
        session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        return redirect()->to(base_url('Masuk/Masuk2020'));
    }

    public function delete($id_mstr)

    {
        $this->MasukModel->delete_mstr($id_mstr);
        session()->setFlashdata('success', 'Data Berhasil Dihapus');
        return redirect()->to(base_url('Masuk/Masuk2020'));
    }
}
