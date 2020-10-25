<?php

namespace App\Controllers;

use App\Models\PkhModel;

class Pkh extends BaseController
{
    protected $TmmpModel;
    public function __construct()
    {
        $this->PkhModel = new PkhModel();
    }
    public function index()


    {

        $data = [
            'tittle' => 'Keluarga Harapan',
            'db_kk' => $this->PkhModel->get_kk(),
            'isi' => 'Kategori/v_khrpn',

        ];
        echo view('layout/v_wrapper', $data);
    }
    public function tambah()
    {

        $data = [
            'tittle' => 'Mampu',
            'db_kk' => $this->PkhModel->tambah_data(),
            'isi' => 'Kategori/v_tambahpkh',

        ];
        echo view('layout/v_wrapper', $data);
    }
    public function edit($id_mstr)
    {

        $data = [
            'id_mstr' => $this->request->getPost('id_mstr'),
            'nik' => $this->request->getPost('nik'),
            'nama' => $this->request->getPost('nama'),
            'kategori' => $this->request->getPost('kategori'),


        ];
        $this->PkhModel->tambah_edit($data, $id_mstr);
        session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        return redirect()->to(base_url('Pkh'));
    }

    public function ubah($id_mstr)
    {

        $data = [
            'id_mstr' => $this->request->getPost('id_mstr'),
            'nik' => $this->request->getPost('nik'),
            'nama' => $this->request->getPost('nama'),
            'kategori' => $this->request->getPost('kategori'),


        ];
        $this->PkhModel->tambah_edit($data, $id_mstr);
        session()->setFlashdata('ubah', 'Data Berhasil Diubah');
        return redirect()->to(base_url('Pkh'));
    }
}
