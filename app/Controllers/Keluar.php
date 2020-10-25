<?php



namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\KeluarModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class Keluar extends BaseController
{

    protected $KeluarModel;
    public function __construct()
    {
        $this->KeluarModel = new KeluarModel();
    }

    public function index()
    {

        $data = [
            'tittle' => 'Keluar',
            'isi' => 'Sirkulasi/v_klr',

        ];
        echo view('layout/v_wrapper', $data);
    }
    public function keluar2020()
    {

        $data = [
            'tittle' => 'Keluar 2020',
            'db_mstr' =>  $this->KeluarModel->get_meninggal(),
            'isi' => 'Sirkulasi/v_keluar2020',

        ];
        echo view('layout/v_wrapper', $data);
    }
    public function tambah()
    {

        $data = [
            'tittle' => 'Data Penduduk',
            'db_mstr' => $this->KeluarModel->tambah_data(),
            'isi' => 'Sirkulasi/v_tambahkeluar2020',

        ];
        echo view('layout/v_wrapper', $data);
    }
    public function edit($id_mstr)
    {

        $data = [
            'id_mstr' => $this->request->getPost('id_mstr'),
            'nik' => $this->request->getPost('nik'),
            'nama' => $this->request->getPost('nama'),
            'stts_hidup' => $this->request->getPost('stts_hidup'),
            'tgl_mmp' => $this->request->getPost('tgl_mmp'),
            'pelapor' => $this->request->getPost('pelapor'),
            'alamat_astj' => $this->request->getPost('alamat_astj'),
            'keg_astj' => $this->request->getPost('keg_astj')


        ];
        $this->KeluarModel->tambah_edit($data, $id_mstr);
        session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        return redirect()->to(base_url('Keluar/keluar2020'));
    }
    public function ubah($id_mstr)
    {

        $data = [
            'id_mstr' => $this->request->getPost('id_mstr'),
            'nik' => $this->request->getPost('nik'),
            'nama' => $this->request->getPost('nama'),
            'stts_hidup' => $this->request->getPost('stts_hidup'),
            'tgl_mmp' => $this->request->getPost('tgl_mmp'),
            'pelapor' => $this->request->getPost('pelapor'),
            'alamat_astj' => $this->request->getPost('alamat_astj'),
            'keg_astj' => $this->request->getPost('keg_astj')


        ];
        $this->KeluarModel->tambah_edit($data, $id_mstr);
        session()->setFlashdata('ubah', 'Data Berhasil Diubah');
        return redirect()->to(base_url('Keluar/keluar2020'));
    }
}
