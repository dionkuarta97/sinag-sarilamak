<?php

namespace App\Models;

use CodeIgniter\Model;

class MstrModel extends Model
{

    public function get_mstr()
    {
        return $this->db->table('db_mstr')

            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->get()->getResultArray();
    }


    public function detail_mstr($id_mstr)
    {

        return $this->db->table('db_mstr')->where('id_mstr', $id_mstr)->get()->getRowArray();
    }
    public function insert_mstr($data)
    {

        return $this->db->table('db_mstr')->insert($data);
    }


    public function update_mstr($data, $id_mstr)
    {
        return $this->db->table('db_mstr')->update($data, ['id_mstr' => $id_mstr]);
    }

    public function delete_mstr($id_mstr)
    {

        return $this->db->table('db_mstr')->delete(['id_mstr' => $id_mstr]);
    }
}
