<?php

namespace App\Models;

use CodeIgniter\Model;

class MeninggalModel extends Model
{
    protected $table = 'db_lahir';
    protected $primaryKey = 'id_lahir';

    public function get_meninggal()
    {
        return $this->db->table('db_mstr')->where('stts_hidup', 'Meninggal')
            ->where('YEAR(tgl_mmp)', 2020)
            ->get()->getResultArray();
    }
    public function tambah_data()
    {
        return $this->db->table('db_mstr')

            ->whereIn('stts_hidup', ['Ada', 'Lahir', 'Masuk'])->get()->getResultArray();
    }
    public function tambah_edit($data, $id_mstr)
    {
        return $this->db->table('db_mstr')->update($data, ['id_mstr' => $id_mstr]);
    }
}
