<?php

namespace App\Models;

use CodeIgniter\Model;

class MstrModel extends Model
{


    function get_datatables()
    {
        if (@$_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%'";
        } else {
            $kondisi_search = "id_mstr != ''";
        }


        if ($_POST['length'] != -1);
        $builder = $this->db->table('db_mstr');
        $query = $builder->select('*')
            ->where($kondisi_search)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->limit($_POST['length'], $_POST['start'])
            ->get();
        return $query->getResult();
    }


    function count_filtered()
    {
        if (@$_POST['search']['value']) {
            $search = @$_POST['search']['value'];
            $kondisi_search = "AND (nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%' OR jekel LIKE '%$search%')";
        } else {
            $kondisi_search = "";
        }

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr != '' $kondisi_search AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }
    function count_all()
    {

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    public function get_mstr()
    {

        return $this->db->table('db_mstr')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->get()
            ->getResultArray();
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
