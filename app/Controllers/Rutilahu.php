<?php

namespace App\Controllers;

use App\Models\RutilahuModel;

class Rutilahu extends BaseController
{
    protected $Rutilahumodel;
    public function __construct()
    {
        $this->RutilahuModel = new RutilahuModel();
    }
    public function index()


    {

        $data = [
            'tittle' => 'RUTILAHU',
            'db_kk' => $this->RutilahuModel->get_kk(),
            'isi' => 'Kategori/v_rutilahu',

        ];
        echo view('layout/v_wrapper', $data);
    }
    public function tambah()
    {

        $data = [
            'tittle' => 'Mampu',
            'db_kk' => $this->RutilahuModel->tambah_data(),
            'isi' => 'Kategori/v_tambahrutilahu',

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
        $this->RutilahuModel->tambah_edit($data, $id_mstr);
        session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        return redirect()->to(base_url('Rutilahu'));
    }

    public function ubah($id_mstr)
    {

        $data = [
            'id_mstr' => $this->request->getPost('id_mstr'),
            'nik' => $this->request->getPost('nik'),
            'nama' => $this->request->getPost('nama'),
            'kategori' => $this->request->getPost('kategori'),


        ];
        $this->RutilahuModel->tambah_edit($data, $id_mstr);
        session()->setFlashdata('ubah', 'Data Berhasil Diubah');
        return redirect()->to(base_url('Rutilahu'));
    }
}
