<?php

namespace App\Controllers;

use App\Models\TmmpModel;

class Tmmp extends BaseController
{
    protected $TmmpModel;
    public function __construct()
    {
        $this->TmmpModel = new TmmpModel();
    }
    public function index()


    {

        $data = [
            'tittle' => 'Tidak Mampu',
            'db_kk' => $this->TmmpModel->get_kk(),
            'isi' => 'Kategori/v_tmmp',

        ];
        echo view('layout/v_wrapper', $data);
    }

    public function tambah()
    {

        $data = [
            'tittle' => 'Mampu',
            'db_kk' => $this->TmmpModel->tambah_data(),
            'isi' => 'Kategori/v_tambah',

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
        $this->TmmpModel->tambah_edit($data, $id_mstr);
        session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        return redirect()->to(base_url('Tmmp'));
    }

    public function ubah($id_mstr)
    {

        $data = [
            'id_mstr' => $this->request->getPost('id_mstr'),
            'nik' => $this->request->getPost('nik'),
            'nama' => $this->request->getPost('nama'),
            'kategori' => $this->request->getPost('kategori'),


        ];
        $this->TmmpModel->tambah_edit($data, $id_mstr);
        session()->setFlashdata('ubah', 'Data Berhasil Diubah');
        return redirect()->to(base_url('Tmmp'));
    }
}
