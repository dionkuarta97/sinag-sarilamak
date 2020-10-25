<?php



namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MeninggalModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class Meninggal extends BaseController
{

    protected $LahirModel;
    public function __construct()
    {
        $this->MeninggalModel = new MeninggalModel();
    }

    public function index()
    {

        $data = [
            'tittle' => 'Meninggal',
            'isi' => 'Sirkulasi/v_mnnggl',

        ];
        echo view('layout/v_wrapper', $data);
    }
    public function meninggal2020()
    {

        $data = [
            'tittle' => 'Meninggal 2020',
            'db_mstr' =>  $this->MeninggalModel->get_meninggal(),
            'isi' => 'Sirkulasi/v_meninggal2020',

        ];
        echo view('layout/v_wrapper', $data);
    }
    public function tambah()
    {

        $data = [
            'tittle' => 'Data Penduduk',
            'db_mstr' => $this->MeninggalModel->tambah_data(),
            'isi' => 'Sirkulasi/v_tambahmeninggal2020',

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
            'pelapor' => $this->request->getPost('pelapor')


        ];
        $this->MeninggalModel->tambah_edit($data, $id_mstr);
        session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        return redirect()->to(base_url('Meninggal/meninggal2020'));
    }
    public function ubah($id_mstr)
    {

        $data = [
            'id_mstr' => $this->request->getPost('id_mstr'),
            'nik' => $this->request->getPost('nik'),
            'nama' => $this->request->getPost('nama'),
            'stts_hidup' => $this->request->getPost('stts_hidup'),
            'tgl_mmp' => $this->request->getPost('tgl_mmp'),
            'pelapor' => $this->request->getPost('pelapor')


        ];
        $this->MeninggalModel->tambah_edit($data, $id_mstr);
        session()->setFlashdata('ubah', 'Data Berhasil Diubah');
        return redirect()->to(base_url('Meninggal/meninggal2020'));
    }
}
