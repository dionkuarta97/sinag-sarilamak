<?php

namespace App\Models;

use CodeIgniter\Model;

class UsiaModel extends Model
{
    public function get_lansia()
    {
        return $this->db->table('db_mstr')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->where('YEAR(CURDATE()) - YEAR(tgl_lahir) >=', 60)
            ->get()->getResultArray();
    }
}
