<?php

namespace App\Controllers;

use App\Models\YptModel;

class Ypt extends BaseController
{
    protected $Rutilahumodel;
    public function __construct()
    {
        $this->YptModel = new YptModel();
    }
    public function index()


    {

        $data = [
            'tittle' => 'Yatim Piatu',
            'db_kk' => $this->YptModel->get_ypt(),
            'isi' => 'Kategori/v_ypt',

        ];
        echo view('layout/v_wrapper', $data);
    }
    public function tambah()
    {

        $data = [
            'tittle' => 'Mampu',
            'db_mstr' => $this->YptModel->tambah_data(),
            'isi' => 'Kategori/v_tambahypt',

        ];
        echo view('layout/v_wrapper', $data);
    }
    public function edit($id_mstr)
    {

        $data = [
            'id_mstr' => $this->request->getPost('id_mstr'),
            'nik' => $this->request->getPost('nik'),
            'nama' => $this->request->getPost('nama'),
            'anak' => $this->request->getPost('anak'),


        ];
        $this->YptModel->tambah_edit($data, $id_mstr);
        session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        return redirect()->to(base_url('Ypt'));
    }

    public function ubah($id_mstr)
    {

        $data = [
            'id_mstr' => $this->request->getPost('id_mstr'),
            'nik' => $this->request->getPost('nik'),
            'nama' => $this->request->getPost('nama'),
            'anak' => $this->request->getPost('anak'),


        ];
        $this->YptModel->tambah_edit($data, $id_mstr);
        session()->setFlashdata('ubah', 'Data Berhasil Diubah');
        return redirect()->to(base_url('Ypt'));
    }
}
