<?php

namespace App\Models;

use CodeIgniter\Model;

class KkModel extends Model
{

    function get_datatables()
    {
        if (@$_POST['search']['value']) {
            $search = @$_POST['search']['value'];
            $kondisi_search = "nkk LIKE '%$search%' OR nama LIKE '%$search%'";
        } else {
            $kondisi_search = "id_mstr != ''";
        }


        if (@$_POST['length'] != -1);
        $builder = $this->db->table('db_kk');
        $query = $builder->select('*')
            ->join('db_mstr', 'db_mstr.id_hub = db_kk.id_hub')
            ->where($kondisi_search)
            ->where('db_mstr.id_hub', 1)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->limit(@$_POST['length'], @$_POST['start'])
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

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr INNER JOIN db_kk ON db_mstr.id_hub = db_kk.id_hub WHERE id_mstr != '' $kondisi_search AND db_mstr.id_hub=1 AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }
    function count_all()
    {

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr INNER JOIN db_kk ON db_mstr.id_hub=db_kk.id_hub WHERE id_mstr AND db_mstr.id_hub=1 AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    public function get_kk()
    {
        return $this->db->table('db_kk')

            ->join('db_mstr', 'db_mstr.id_hub = db_kk.id_hub')
            ->where('db_mstr.id_hub', 1)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->get()
            ->getResultArray();
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
