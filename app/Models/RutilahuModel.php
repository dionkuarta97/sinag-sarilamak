<?php

namespace App\Models;

use CodeIgniter\Model;

class RutilahuModel extends Model
{
    protected $table = 'db_kk';
    protected $primaryKey = 'id_hub';
    public function get_kk()
    {
        return $this->db->table('db_kk')

            ->join('db_mstr', 'db_mstr.id_hub = db_kk.id_hub')
            ->where('db_mstr.id_hub', 1)->where('db_mstr.kategori', 'RUTILAHU')->get()->getResultArray();
    }

    public function detail_kk($nkk)
    {
        return $this->db->table('db_kk')

            ->join('db_mstr', 'db_mstr.id_hub = db_kk.id_hub')
            ->where('db_mstr.nkk', $nkk)->where('db_mstr.stts_hidup', 'Ada')->get()->getResultArray();
    }

    public function tambah_data()
    {
        return $this->db->table('db_kk')

            ->join('db_mstr', 'db_mstr.id_hub = db_kk.id_hub')
            ->where('db_mstr.id_hub', 1)->where('db_mstr.kategori', 'Mampu')->get()->getResultArray();
    }
    public function tambah_edit($data, $id_mstr)
    {
        return $this->db->table('db_mstr')->update($data, ['id_mstr' => $id_mstr]);
    }
}
