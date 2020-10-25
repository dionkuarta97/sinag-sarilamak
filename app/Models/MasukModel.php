<?php

namespace App\Models;

use CodeIgniter\Model;

class MasukModel extends Model
{


    public function get_2020()
    {
        return $this->db->table('db_mstr')
            ->where('stts_hidup', 'Masuk')
            ->where('YEAR(tgl_mmp)', 2020)
            ->get()->getResultArray();
    }

    public function insert_mstr($data)
    {

        return $this->db->table('db_mstr')->insert($data);
    }
    public function delete_mstr($id_mstr)
    {

        return $this->db->table('db_mstr')->delete(['id_mstr' => $id_mstr]);
    }
}
