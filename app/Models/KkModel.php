<?php

namespace App\Models;

use CodeIgniter\Model;

class KkModel extends Model
{
    protected $table = 'db_kk';
    protected $primaryKey = 'id_hub';
    public function get_kk()
    {
        return $this->db->table('db_kk')

            ->join('db_mstr', 'db_mstr.id_hub = db_kk.id_hub')
            ->where('db_mstr.id_hub', 1)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->get()->getResultArray();
    }

    public function detail_kk($nkk)
    {
        return $this->db->table('db_kk')

            ->join('db_mstr', 'db_mstr.id_hub = db_kk.id_hub')

            ->where('db_mstr.nkk', $nkk)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->get()->getResultArray();
    }
}
