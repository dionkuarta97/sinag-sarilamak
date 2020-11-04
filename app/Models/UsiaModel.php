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

    function get_datatables_contoh()
    {
        if (@$_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%'";
        } else {
            $kondisi_search = "id_mstr != ''";
        }


        if (@$_POST['length'] != -1);
        $builder = $this->db->table('db_mstr')->whereIn('TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE())', [17, 18, 19]);
        $query = $builder->select('*')
            ->where($kondisi_search)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->limit(@$_POST['length'], @$_POST['start'])
            ->get();




        return $query->getResult();
    }

    function count_filtered_contoh()
    {
        if (@$_POST['search']['value']) {
            $search = @$_POST['search']['value'];
            $kondisi_search = "AND (nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%' OR jekel LIKE '%$search%')";
        } else {
            $kondisi_search = "";
        }

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr != '' $kondisi_search AND stts_hidup IN ('Ada', 'Masuk', 'Lahir') AND TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) BETWEEN 17 AND 19";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    function count_all_contoh()
    {

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr AND stts_hidup IN ('Ada', 'Masuk', 'Lahir') AND TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) BETWEEN 17 AND 19";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }
}
