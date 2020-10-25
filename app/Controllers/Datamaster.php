<?php



namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\MstrModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class Datamaster extends BaseController
{

    protected $MstrModel;
    public function __construct()
    {
        $this->MstrModel = new MstrModel();
    }

    public function index()
    {

        $data = [
            'tittle' => 'Data Master',
            'db_mstr' => $this->MstrModel->get_mstr(),
            'isi' => 'Datapenduduk/v_mstr',

        ];
        echo view('layout/v_wrapper', $data);
    }

    public function detail($id_mstr)
    {

        $data = [
            'tittle' => 'Detail Penduduk',
            'db_mstr' => $this->MstrModel->detail_mstr($id_mstr),
            'isi' => 'Datapenduduk/v_detailmstr',

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
        ];
        $this->MstrModel->insert_mstr($data);
        session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        return redirect()->to(base_url('Datamaster'));
    }



    public function update($id_mstr)
    {

        $data = [
            'id_mstr' => $this->request->getPost('id_mstr'),
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
        ];
        $this->MstrModel->update_mstr($data, $id_mstr);
        session()->setFlashdata('success', 'Data Berhasil Diubah');
        return redirect()->to(base_url('Datamaster/detail/' . $id_mstr));
    }

    public function delete($id_mstr)

    {
        $this->MstrModel->delete_mstr($id_mstr);
        session()->setFlashdata('success', 'Data Berhasil Dihapus');
        return redirect()->to(base_url('Datamaster'));
    }

    public function upload()
    {
        $validation = \Config\Services::validation();
        $valid = $this->validate(
            [
                'uploadexcel' => [
                    'label' => 'inputan file',
                    'rules' => 'uploaded[uploadexcel]|ext_in[uploadexcel,xls,xlsx]',
                    'errors' => [
                        'uploaded' => '{field} wajib diisi',
                        'ext_in' => '{field} format harus xls/xlsx'
                    ]
                ]
            ]
        );
        if (!$valid) {

            $this->session->setFlashdata('pesan', $validation->getError('uploadexcel'));

            return redirect()->to('Datamaster');
        } else {
            $upload_excel = $this->request->getFile('uploadexcel');
            $ext = $upload_excel->getClientExtension();
            if ($ext == 'xls') {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }

            $spreadsheet = $render->load($upload_excel);
            $data = $spreadsheet->getActiveSheet()->toArray();

            $jumlaherror = 0;
            $jumlahsukses = 0;

            foreach ($data as $x => $row) {
                if ($x == 0) {
                    continue;
                }

                $nik = $row[0];
                $nkk = $row[1];
                $nama = $row[2];
                $tmp_lahir = $row[3];
                $tgl_lahir = $row[4];
                $jekel = $row[5];
                $kenagarian = $row[6];
                $jorong = $row[7];
                $agama = $row[8];
                $pekerjaan = $row[9];
                $stts_kwn = $row[10];
                $kategori = $row[11];
                $id_hub = $row[12];
                $stts_hidup = $row[13];
                $anak = $row[14];
                $nama_ayah = $row[15];
                $nama_ibu = $row[16];

                $db = \Config\Database::connect();

                $ceknik = $db->table('db_mstr')->getWhere(['nik' => $nik])->getResult();
                if (count($ceknik) > 0) {
                    $jumlaherror++;
                } else {
                    $datasimpan = [
                        'nik' => $nik,
                        'nkk' => $nkk,
                        'nama' => $nama,
                        'tmp_lahir' => $tmp_lahir,
                        'tgl_lahir' => $tgl_lahir,
                        'jekel' => $jekel,
                        'kenagarian' => $kenagarian,
                        'jorong' => $jorong,
                        'agama' => $agama,
                        'pekerjaan' => $pekerjaan,
                        'stts_kwn' => $stts_kwn,
                        'kategori' => $kategori,
                        'id_hub' => $id_hub,
                        'stts_hidup' => $stts_hidup,
                        'anak' => $anak,
                        'nama_ayah' => $nama_ayah,
                        'nama_ibu' => $nama_ibu
                    ];
                    $db->table('db_mstr')->insert($datasimpan);
                    $jumlahsukses++;
                }
            }
            $this->session->setFlashdata('sukses', "$jumlaherror Data tidak bisa disimpan <br> $jumlahsukses Data bisa disimpan");

            return redirect()->to(base_url('Datamaster'));
        }
    }

    public function excel()
    {
        $data['db_mstr'] =  $this->MstrModel->get_mstr();


        $spreadsheet = new Spreadsheet;

        $spreadsheet->getProperties()->setCreator("Dion Kuarta");
        $spreadsheet->getProperties()->setLastModifiedBy("Dion Kuarta");

        $spreadsheet->getProperties()->setTitle("Data Master");
        $spreadsheet->getActiveSheetIndex(0);



        $spreadsheet->getActiveSheet()->setCellValue('A1', 'NO');
        $spreadsheet->getActiveSheet()->setCellValue('B1', 'NIK');
        $spreadsheet->getActiveSheet()->setCellValue('C1', 'NKK');
        $spreadsheet->getActiveSheet()->setCellValue('D1', 'NAMA');
        $spreadsheet->getActiveSheet()->setCellValue('E1', 'TANGGAL LAHIR');
        $spreadsheet->getActiveSheet()->setCellValue('F1', 'UMUR');
        $spreadsheet->getActiveSheet()->setCellValue('G1', 'AGAMA');
        $spreadsheet->getActiveSheet()->setCellValue('H1', 'JENIS KELAMIN');
        $spreadsheet->getActiveSheet()->setCellValue('I1', 'PEKERJAAN');

        $baris = 2;
        $no = 1;

        foreach ($data['db_mstr'] as $mstr) {

            $spreadsheet->getActiveSheet()->setCellValue('A' . $baris, $no++);
            $spreadsheet->getActiveSheet()->setCellValueExplicit('B' . $baris, $mstr['nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $spreadsheet->getActiveSheet()->setCellValueExplicit('C' . $baris, $mstr['nkk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $spreadsheet->getActiveSheet()->setCellValue('D' . $baris, $mstr['nama']);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $baris, tanggal_indo($mstr['tgl_lahir']));
            $spreadsheet->getActiveSheet()->setCellValue('F' . $baris, hitung_umur($mstr['tgl_lahir']));
            $spreadsheet->getActiveSheet()->setCellValue('G' . $baris, $mstr['agama']);
            $spreadsheet->getActiveSheet()->setCellValue('H' . $baris, $mstr['jekel']);
            $spreadsheet->getActiveSheet()->setCellValue('I' . $baris, $mstr['pekerjaan']);

            $baris++;
        }



        $spreadsheet->getActiveSheet()->setTitle("Data Master");
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Data_Master.Xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);

        $writer->save('php://output');

        exit;
    }


    public function suket_meninggal()
    {

        echo view('Surat/suketmeninggal');
    }
}
