<?php

namespace App\Models;

use CodeIgniter\Model;

class LahirModel extends Model
{


    public function get_2020()
    {
        return $this->db->table('db_mstr')
            ->where('stts_hidup', 'lahir')
            ->where('YEAR(tgl_lahir)', 2020)
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
