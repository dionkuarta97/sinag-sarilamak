<?php

namespace App\Models;

use CodeIgniter\Model;

class YptModel extends Model
{
    protected $table = 'db_mstr';
    protected $primaryKey = 'id_mstr';

    public function get_ypt()
    {
        return $this->db->table('db_mstr')->where('stts_hidup', 'Ada')->whereIn('anak', ['Yatim', 'Piatu', 'Yatim Piatu'])->get()->getResultArray();
    }
    public function tambah_data()
    {
        return $this->db->table('db_mstr')

            ->where('stts_hidup', 'ada')->where('anak', 'Lengkap')->get()->getResultArray();
    }


    public function tambah_edit($data, $id_mstr)
    {
        return $this->db->table('db_mstr')->update($data, ['id_mstr' => $id_mstr]);
    }
}
