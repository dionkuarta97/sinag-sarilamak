<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{

    public function get_all()
    {
        return $this->db->table('db_mstr')

            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->countAllResults();
    }

    public function get_laki()
    {

        return $this->db->table('db_mstr')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->where('db_mstr.jekel', 'LK')
            ->get()
            ->getResultArray();
    }


    function get_datatables_laki()
    {
        if (@$_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%'";
        } else {
            $kondisi_search = "id_mstr != ''";
        }


        if (@$_POST['length'] != -1);
        $builder = $this->db->table('db_mstr');
        $query = $builder->select('*')
            ->where($kondisi_search)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->where('db_mstr.jekel', 'LK')
            ->limit(@$_POST['length'], @$_POST['start'])
            ->get();
        return $query->getResult();
    }


    function count_filtered_laki()
    {
        if (@$_POST['search']['value']) {
            $search = @$_POST['search']['value'];
            $kondisi_search = "AND (nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%' OR jekel LIKE '%$search%')";
        } else {
            $kondisi_search = "";
        }

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr != '' $kondisi_search AND jekel='LK' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    function count_all_laki()
    {

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr AND jekel='LK' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }


    public function get_perempuan()
    {

        return $this->db->table('db_mstr')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->where('db_mstr.jekel', 'PR')
            ->get()
            ->getResultArray();
    }

    function get_datatables_perempuan()
    {
        if (@$_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%'";
        } else {
            $kondisi_search = "id_mstr != ''";
        }


        if (@$_POST['length'] != -1);
        $builder = $this->db->table('db_mstr');
        $query = $builder->select('*')
            ->where($kondisi_search)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->where('db_mstr.jekel', 'PR')
            ->limit(@$_POST['length'], @$_POST['start'])
            ->get();
        return $query->getResult();
    }


    function count_filtered_perempuan()
    {
        if (@$_POST['search']['value']) {
            $search = @$_POST['search']['value'];
            $kondisi_search = "AND (nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%' OR jekel LIKE '%$search%')";
        } else {
            $kondisi_search = "";
        }

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr != '' $kondisi_search AND jekel='PR' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }
    function count_all_perempuan()
    {

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr AND jekel='PR' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }


    public function get_kk()
    {
        return $this->db->table('db_mstr')

            ->where('db_mstr.id_hub', 1)

            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->countAllResults();
    }

    public function get_kk_sarilamak()
    {
        return $this->db->table('db_kk')

            ->join('db_mstr', 'db_mstr.id_hub = db_kk.id_hub')
            ->where('db_mstr.jorong', 'sarilamak')
            ->where('db_mstr.id_hub', 1)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->get()
            ->getResultArray();
    }


    function get_datatables_kk_sarilamak()
    { {
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
                ->where('db_mstr.jorong', 'sarilamak')
                ->where('db_mstr.id_hub', 1)
                ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
                ->limit(@$_POST['length'], @$_POST['start'])
                ->get();
            return $query->getResult();
        }
    }


    function count_filtered_kk_sarilamak()
    {
        if (@$_POST['search']['value']) {
            $search = @$_POST['search']['value'];
            $kondisi_search = "AND (nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%' OR jekel LIKE '%$search%')";
        } else {
            $kondisi_search = "";
        }

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr INNER JOIN db_kk ON db_mstr.id_hub = db_kk.id_hub WHERE id_mstr != '' $kondisi_search AND db_mstr.id_hub=1 AND db_mstr.jorong='sarilamak' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }
    function count_all_kk_sarilamak()
    {

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr INNER JOIN db_kk ON db_mstr.id_hub=db_kk.id_hub WHERE id_mstr AND db_mstr.id_hub=1 AND db_mstr.jorong='sarilamak' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    public function get_kk_purwajaya()
    {
        return $this->db->table('db_kk')

            ->join('db_mstr', 'db_mstr.id_hub = db_kk.id_hub')
            ->where('db_mstr.jorong', 'purwajaya')
            ->where('db_mstr.id_hub', 1)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->get()
            ->getResultArray();
    }


    function get_datatables_kk_purwajaya()
    { {
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
                ->where('db_mstr.jorong', 'purwajaya')
                ->where('db_mstr.id_hub', 1)
                ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
                ->limit(@$_POST['length'], @$_POST['start'])
                ->get();
            return $query->getResult();
        }
    }


    function count_filtered_kk_purwajaya()
    {
        if (@$_POST['search']['value']) {
            $search = @$_POST['search']['value'];
            $kondisi_search = "AND (nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%' OR jekel LIKE '%$search%')";
        } else {
            $kondisi_search = "";
        }

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr INNER JOIN db_kk ON db_mstr.id_hub = db_kk.id_hub WHERE id_mstr != '' $kondisi_search AND db_mstr.id_hub=1 AND db_mstr.jorong='purwajaya' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }
    function count_all_kk_purwajaya()
    {

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr INNER JOIN db_kk ON db_mstr.id_hub=db_kk.id_hub WHERE id_mstr AND db_mstr.id_hub=1 AND db_mstr.jorong='purwajaya' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    public function get_kk_ketinggian()
    {
        return $this->db->table('db_kk')

            ->join('db_mstr', 'db_mstr.id_hub = db_kk.id_hub')
            ->where('db_mstr.jorong', 'ketinggian')
            ->where('db_mstr.id_hub', 1)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->get()
            ->getResultArray();
    }

    function get_datatables_kk_ketinggian()
    { {
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
                ->where('db_mstr.jorong', 'ketinggian')
                ->where('db_mstr.id_hub', 1)
                ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
                ->limit(@$_POST['length'], @$_POST['start'])
                ->get();
            return $query->getResult();
        }
    }


    function count_filtered_kk_ketinggian()
    {
        if (@$_POST['search']['value']) {
            $search = @$_POST['search']['value'];
            $kondisi_search = "AND (nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%' OR jekel LIKE '%$search%')";
        } else {
            $kondisi_search = "";
        }

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr INNER JOIN db_kk ON db_mstr.id_hub = db_kk.id_hub WHERE id_mstr != '' $kondisi_search AND db_mstr.id_hub=1 AND db_mstr.jorong='ketinggian' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }
    function count_all_kk_ketinggian()
    {

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr INNER JOIN db_kk ON db_mstr.id_hub=db_kk.id_hub WHERE id_mstr AND db_mstr.id_hub=1 AND db_mstr.jorong='ketinggian' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }


    public function get_kk_air_putih()
    {
        return $this->db->table('db_kk')

            ->join('db_mstr', 'db_mstr.id_hub = db_kk.id_hub')
            ->where('db_mstr.jorong', 'air putih')
            ->where('db_mstr.id_hub', 1)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->get()
            ->getResultArray();
    }


    function get_datatables_kk_air_putih()
    { {
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
                ->where('db_mstr.jorong', 'air putih')
                ->where('db_mstr.id_hub', 1)
                ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
                ->limit(@$_POST['length'], @$_POST['start'])
                ->get();
            return $query->getResult();
        }
    }


    function count_filtered_kk_air_putih()
    {
        if (@$_POST['search']['value']) {
            $search = @$_POST['search']['value'];
            $kondisi_search = "AND (nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%' OR jekel LIKE '%$search%')";
        } else {
            $kondisi_search = "";
        }

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr INNER JOIN db_kk ON db_mstr.id_hub = db_kk.id_hub WHERE id_mstr != '' $kondisi_search AND db_mstr.id_hub=1 AND db_mstr.jorong='air putih' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }
    function count_all_kk_air_putih()
    {

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr INNER JOIN db_kk ON db_mstr.id_hub=db_kk.id_hub WHERE id_mstr AND db_mstr.id_hub=1 AND db_mstr.jorong='air putih' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    public function get_kk_buluh_kasok()
    {
        return $this->db->table('db_kk')

            ->join('db_mstr', 'db_mstr.id_hub = db_kk.id_hub')
            ->where('db_mstr.jorong', 'buluh kasok')
            ->where('db_mstr.id_hub', 1)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->get()
            ->getResultArray();
    }

    function get_datatables_kk_buluh_kasok()
    { {
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
                ->where('db_mstr.jorong', 'buluh kasok')
                ->where('db_mstr.id_hub', 1)
                ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
                ->limit(@$_POST['length'], @$_POST['start'])
                ->get();
            return $query->getResult();
        }
    }


    function count_filtered_kk_buluh_kasok()
    {
        if (@$_POST['search']['value']) {
            $search = @$_POST['search']['value'];
            $kondisi_search = "AND (nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%' OR jekel LIKE '%$search%')";
        } else {
            $kondisi_search = "";
        }

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr INNER JOIN db_kk ON db_mstr.id_hub = db_kk.id_hub WHERE id_mstr != '' $kondisi_search AND db_mstr.id_hub=1 AND db_mstr.jorong='buluh kasok' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }
    function count_all_kk_buluh_kasok()
    {

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr INNER JOIN db_kk ON db_mstr.id_hub=db_kk.id_hub WHERE id_mstr AND db_mstr.id_hub=1 AND db_mstr.jorong='buluh kasok' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }


    public function get_sarilamak_p()
    {

        return $this->db->table('db_mstr')
            ->where('db_mstr.jorong', 'sarilamak')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->get()
            ->getResultArray();
    }

    function get_datatables_sarilamak()
    {
        if (@$_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%'";
        } else {
            $kondisi_search = "id_mstr != ''";
        }


        if (@$_POST['length'] != -1);
        $builder = $this->db->table('db_mstr');
        $query = $builder->select('*')
            ->where($kondisi_search)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->where('db_mstr.jorong', 'sarilamak')
            ->limit(@$_POST['length'], @$_POST['start'])
            ->get();
        return $query->getResult();
    }


    function count_filtered_sarilamak()
    {
        if (@$_POST['search']['value']) {
            $search = @$_POST['search']['value'];
            $kondisi_search = "AND (nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%' OR jekel LIKE '%$search%')";
        } else {
            $kondisi_search = "";
        }

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr != '' $kondisi_search AND jorong='sarilamak' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }
    function count_all_sarilamak()
    {

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr AND jorong='sarilamak' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    public function get_purwajaya_p()
    {

        return $this->db->table('db_mstr')
            ->where('db_mstr.jorong', 'purwajaya')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->get()
            ->getResultArray();
    }

    function get_datatables_purwajaya()
    {
        if (@$_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%'";
        } else {
            $kondisi_search = "id_mstr != ''";
        }


        if (@$_POST['length'] != -1);
        $builder = $this->db->table('db_mstr');
        $query = $builder->select('*')
            ->where($kondisi_search)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->where('db_mstr.jorong', 'purwajaya')
            ->limit(@$_POST['length'], @$_POST['start'])
            ->get();
        return $query->getResult();
    }


    function count_filtered_purwajaya()
    {
        if (@$_POST['search']['value']) {
            $search = @$_POST['search']['value'];
            $kondisi_search = "AND (nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%' OR jekel LIKE '%$search%')";
        } else {
            $kondisi_search = "";
        }

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr != '' $kondisi_search AND jorong='purwajaya' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }
    function count_all_purwajaya()
    {

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr AND jorong='purwajaya' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    public function get_ketinggian_p()
    {

        return $this->db->table('db_mstr')
            ->where('db_mstr.jorong', 'ketinggian')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->get()
            ->getResultArray();
    }

    function get_datatables_ketinggian()
    {
        if (@$_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%'";
        } else {
            $kondisi_search = "id_mstr != ''";
        }


        if (@$_POST['length'] != -1);
        $builder = $this->db->table('db_mstr');
        $query = $builder->select('*')
            ->where($kondisi_search)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->where('db_mstr.jorong', 'ketinggian')
            ->limit(@$_POST['length'], @$_POST['start'])
            ->get();
        return $query->getResult();
    }


    function count_filtered_ketinggian()
    {
        if (@$_POST['search']['value']) {
            $search = @$_POST['search']['value'];
            $kondisi_search = "AND (nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%' OR jekel LIKE '%$search%')";
        } else {
            $kondisi_search = "";
        }

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr != '' $kondisi_search AND jorong='ketinggian' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }
    function count_all_ketinggian()
    {

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr AND jorong='ketinggian' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    public function get_air_putih_p()
    {

        return $this->db->table('db_mstr')
            ->where('db_mstr.jorong', 'air putih')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->get()
            ->getResultArray();
    }

    function get_datatables_air_putih()
    {
        if (@$_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%'";
        } else {
            $kondisi_search = "id_mstr != ''";
        }


        if (@$_POST['length'] != -1);
        $builder = $this->db->table('db_mstr');
        $query = $builder->select('*')
            ->where($kondisi_search)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->where('db_mstr.jorong', 'air putih')
            ->limit(@$_POST['length'], @$_POST['start'])
            ->get();
        return $query->getResult();
    }


    function count_filtered_air_putih()
    {
        if (@$_POST['search']['value']) {
            $search = @$_POST['search']['value'];
            $kondisi_search = "AND (nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%' OR jekel LIKE '%$search%')";
        } else {
            $kondisi_search = "";
        }

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr != '' $kondisi_search AND jorong='air putih' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }
    function count_all_air_putih()
    {

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr AND jorong='air putih' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    public function get_buluh_kasok_p()
    {

        return $this->db->table('db_mstr')
            ->where('db_mstr.jorong', 'buluh kasok')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->get()
            ->getResultArray();
    }

    function get_datatables_buluh_kasok()
    {
        if (@$_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%'";
        } else {
            $kondisi_search = "id_mstr != ''";
        }


        if (@$_POST['length'] != -1);
        $builder = $this->db->table('db_mstr');
        $query = $builder->select('*')
            ->where($kondisi_search)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->where('db_mstr.jorong', 'buluh kasok')
            ->limit(@$_POST['length'], @$_POST['start'])
            ->get();
        return $query->getResult();
    }


    function count_filtered_buluh_kasok()
    {
        if (@$_POST['search']['value']) {
            $search = @$_POST['search']['value'];
            $kondisi_search = "AND (nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%' OR jekel LIKE '%$search%')";
        } else {
            $kondisi_search = "";
        }

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr != '' $kondisi_search AND jorong='buluh kasok' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    function count_all_buluh_kasok()
    {

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr AND jorong='buluh kasok' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }



    function get_datatables_islam()
    {
        if (@$_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%'";
        } else {
            $kondisi_search = "id_mstr != ''";
        }


        if (@$_POST['length'] != -1);
        $builder = $this->db->table('db_mstr');
        $query = $builder->select('*')
            ->where($kondisi_search)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->where('db_mstr.agama', 'islam')
            ->limit(@$_POST['length'], @$_POST['start'])
            ->get();
        return $query->getResult();
    }


    function count_filtered_islam()
    {
        if (@$_POST['search']['value']) {
            $search = @$_POST['search']['value'];
            $kondisi_search = "AND (nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%' OR jekel LIKE '%$search%')";
        } else {
            $kondisi_search = "";
        }

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr != '' $kondisi_search AND agama='islam' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    function count_all_islam()
    {

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr AND agama='islam' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    public function get_agama_islam_p()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.agama', 'islam')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->get()->getResultArray();
    }

    function get_datatables_protestan()
    {
        if (@$_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%'";
        } else {
            $kondisi_search = "id_mstr != ''";
        }


        if (@$_POST['length'] != -1);
        $builder = $this->db->table('db_mstr');
        $query = $builder->select('*')
            ->where($kondisi_search)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->where('db_mstr.agama', 'protestan')
            ->limit(@$_POST['length'], @$_POST['start'])
            ->get();
        return $query->getResult();
    }


    function count_filtered_protestan()
    {
        if (@$_POST['search']['value']) {
            $search = @$_POST['search']['value'];
            $kondisi_search = "AND (nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%' OR jekel LIKE '%$search%')";
        } else {
            $kondisi_search = "";
        }

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr != '' $kondisi_search AND agama='protestan' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    function count_all_protestan()
    {

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr AND agama='protestan' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    public function get_agama_protestan_p()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.agama', 'protestan')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->get()->getResultArray();
    }

    function get_datatables_katolik()
    {
        if (@$_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%'";
        } else {
            $kondisi_search = "id_mstr != ''";
        }


        if (@$_POST['length'] != -1);
        $builder = $this->db->table('db_mstr');
        $query = $builder->select('*')
            ->where($kondisi_search)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->where('db_mstr.agama', 'katolik')
            ->limit(@$_POST['length'], @$_POST['start'])
            ->get();
        return $query->getResult();
    }


    function count_filtered_katolik()
    {
        if (@$_POST['search']['value']) {
            $search = @$_POST['search']['value'];
            $kondisi_search = "AND (nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%' OR jekel LIKE '%$search%')";
        } else {
            $kondisi_search = "";
        }

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr != '' $kondisi_search AND agama='katolik' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    function count_all_katolik()
    {

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr AND agama='katolik' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    public function get_agama_katolik_p()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.agama', 'katolik')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->get()->getResultArray();
    }

    function get_datatables_hindu()
    {
        if (@$_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%'";
        } else {
            $kondisi_search = "id_mstr != ''";
        }


        if (@$_POST['length'] != -1);
        $builder = $this->db->table('db_mstr');
        $query = $builder->select('*')
            ->where($kondisi_search)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->where('db_mstr.agama', 'hindu')
            ->limit(@$_POST['length'], @$_POST['start'])
            ->get();
        return $query->getResult();
    }


    function count_filtered_hindu()
    {
        if (@$_POST['search']['value']) {
            $search = @$_POST['search']['value'];
            $kondisi_search = "AND (nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%' OR jekel LIKE '%$search%')";
        } else {
            $kondisi_search = "";
        }

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr != '' $kondisi_search AND agama='hindu' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    function count_all_hindu()
    {

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr AND agama='hindu' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    public function get_agama_hindu_p()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.agama', 'hindu')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->get()->getResultArray();
    }

    function get_datatables_buddha()
    {
        if (@$_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%'";
        } else {
            $kondisi_search = "id_mstr != ''";
        }


        if (@$_POST['length'] != -1);
        $builder = $this->db->table('db_mstr');
        $query = $builder->select('*')
            ->where($kondisi_search)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->where('db_mstr.agama', 'buddha')
            ->limit(@$_POST['length'], @$_POST['start'])
            ->get();
        return $query->getResult();
    }


    function count_filtered_buddha()
    {
        if (@$_POST['search']['value']) {
            $search = @$_POST['search']['value'];
            $kondisi_search = "AND (nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%' OR jekel LIKE '%$search%')";
        } else {
            $kondisi_search = "";
        }

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr != '' $kondisi_search AND agama='buddha' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    function count_all_buddha()
    {

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr AND agama='buddha' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    public function get_agama_buddha_p()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.agama', 'buddha')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->get()->getResultArray();
    }

    function get_datatables_konghucu()
    {
        if (@$_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%'";
        } else {
            $kondisi_search = "id_mstr != ''";
        }


        if (@$_POST['length'] != -1);
        $builder = $this->db->table('db_mstr');
        $query = $builder->select('*')
            ->where($kondisi_search)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->where('db_mstr.agama', 'kong hu cu')
            ->limit(@$_POST['length'], @$_POST['start'])
            ->get();
        return $query->getResult();
    }


    function count_filtered_konghucu()
    {
        if (@$_POST['search']['value']) {
            $search = @$_POST['search']['value'];
            $kondisi_search = "AND (nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%' OR jekel LIKE '%$search%')";
        } else {
            $kondisi_search = "";
        }

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr != '' $kondisi_search AND agama='kong hu cu' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    function count_all_konghucu()
    {

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr AND agama='kong hu cu' AND stts_hidup IN ('Ada', 'Masuk', 'Lahir')";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    public function get_agama_konghucu_p()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.agama', 'kong hu cu')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->get()->getResultArray();
    }


    public function get_stunting()
    {

        return $this->db->table('db_mstr')
            ->whereIn('TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE())', [0, 1, 2])
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->get()
            ->getResultArray();
    }

    function get_datatables_stunting()
    {
        if (@$_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%'";
        } else {
            $kondisi_search = "id_mstr != ''";
        }


        if (@$_POST['length'] != -1);
        $builder = $this->db->table('db_mstr')->whereIn('TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE())', [0, 1, 2]);
        $query = $builder->select('*')
            ->where($kondisi_search)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->limit(@$_POST['length'], @$_POST['start'])
            ->get();
        return $query->getResult();
    }

    function count_filtered_stunting()
    {
        if (@$_POST['search']['value']) {
            $search = @$_POST['search']['value'];
            $kondisi_search = "AND (nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%' OR jekel LIKE '%$search%')";
        } else {
            $kondisi_search = "";
        }

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr != '' $kondisi_search AND stts_hidup IN ('Ada', 'Masuk', 'Lahir') AND TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) BETWEEN 0 AND 2";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    function count_all_stunting()
    {

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr AND stts_hidup IN ('Ada', 'Masuk', 'Lahir') AND TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) BETWEEN 0 AND 2";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    public function get_balita()
    {

        return $this->db->table('db_mstr')
            ->whereIn('TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE())', [0, 1, 2, 3, 4])
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->get()
            ->getResultArray();
    }

    function get_datatables_balita()
    {
        if (@$_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%'";
        } else {
            $kondisi_search = "id_mstr != ''";
        }


        if (@$_POST['length'] != -1);
        $builder = $this->db->table('db_mstr')->whereIn('TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE())', [0, 1, 2, 3, 4]);
        $query = $builder->select('*')
            ->where($kondisi_search)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->limit(@$_POST['length'], @$_POST['start'])
            ->get();
        return $query->getResult();
    }

    function count_filtered_balita()
    {
        if (@$_POST['search']['value']) {
            $search = @$_POST['search']['value'];
            $kondisi_search = "AND (nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%' OR jekel LIKE '%$search%')";
        } else {
            $kondisi_search = "";
        }

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr != '' $kondisi_search AND stts_hidup IN ('Ada', 'Masuk', 'Lahir') AND TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) BETWEEN 0 AND 4";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    function count_all_balita()
    {

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr AND stts_hidup IN ('Ada', 'Masuk', 'Lahir') AND TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) BETWEEN 0 AND 4";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    public function get_anak_anak()
    {

        return $this->db->table('db_mstr')
            ->whereIn('TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE())', [5, 6, 7, 8, 9, 10, 11, 12, 13])
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->get()
            ->getResultArray();
    }

    function get_datatables_anak_anak()
    {
        if (@$_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%'";
        } else {
            $kondisi_search = "id_mstr != ''";
        }


        if (@$_POST['length'] != -1);
        $builder = $this->db->table('db_mstr')->whereIn('TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE())', [5, 6, 7, 8, 9, 10, 11, 12, 13]);
        $query = $builder->select('*')
            ->where($kondisi_search)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->limit(@$_POST['length'], @$_POST['start'])
            ->get();
        return $query->getResult();
    }

    function count_filtered_anak_anak()
    {
        if (@$_POST['search']['value']) {
            $search = @$_POST['search']['value'];
            $kondisi_search = "AND (nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%' OR jekel LIKE '%$search%')";
        } else {
            $kondisi_search = "";
        }

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr != '' $kondisi_search AND stts_hidup IN ('Ada', 'Masuk', 'Lahir') AND TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) BETWEEN 5 AND 13";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    function count_all_anak_anak()
    {

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr AND stts_hidup IN ('Ada', 'Masuk', 'Lahir') AND TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) BETWEEN 5 AND 13";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    public function get_remaja()
    {

        return $this->db->table('db_mstr')
            ->whereIn('TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE())', [14, 15, 16])
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->get()
            ->getResultArray();
    }

    function get_datatables_remaja()
    {
        if (@$_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%'";
        } else {
            $kondisi_search = "id_mstr != ''";
        }


        if (@$_POST['length'] != -1);
        $builder = $this->db->table('db_mstr')->whereIn('TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE())', [14, 15, 16]);
        $query = $builder->select('*')
            ->where($kondisi_search)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->limit(@$_POST['length'], @$_POST['start'])
            ->get();
        return $query->getResult();
    }

    function count_filtered_remaja()
    {
        if (@$_POST['search']['value']) {
            $search = @$_POST['search']['value'];
            $kondisi_search = "AND (nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%' OR jekel LIKE '%$search%')";
        } else {
            $kondisi_search = "";
        }

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr != '' $kondisi_search AND stts_hidup IN ('Ada', 'Masuk', 'Lahir') AND TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) BETWEEN 14 AND 16";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    function count_all_remaja()
    {

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr AND stts_hidup IN ('Ada', 'Masuk', 'Lahir') AND TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) BETWEEN 14 AND 16";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    public function get_dewasa()
    {

        return $this->db->table('db_mstr')
            ->whereIn('TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE())', [17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59])
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->get()
            ->getResultArray();
    }

    function get_datatables_dewasa()
    {
        if (@$_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%'";
        } else {
            $kondisi_search = "id_mstr != ''";
        }


        if (@$_POST['length'] != -1);
        $builder = $this->db->table('db_mstr')->whereIn('TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE())', [17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59]);
        $query = $builder->select('*')
            ->where($kondisi_search)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->limit(@$_POST['length'], @$_POST['start'])
            ->get();
        return $query->getResult();
    }

    function count_filtered_dewasa()
    {
        if (@$_POST['search']['value']) {
            $search = @$_POST['search']['value'];
            $kondisi_search = "AND (nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%' OR jekel LIKE '%$search%')";
        } else {
            $kondisi_search = "";
        }

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr != '' $kondisi_search AND stts_hidup IN ('Ada', 'Masuk', 'Lahir') AND TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) BETWEEN 17 AND 59";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    function count_all_dewasa()
    {

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr AND stts_hidup IN ('Ada', 'Masuk', 'Lahir') AND TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) BETWEEN 17 AND 59";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    public function get_lansia()
    {

        return $this->db->table('db_mstr')
            ->where('TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) >=', 60)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->get()
            ->getResultArray();
    }

    function get_datatables_lansia()
    {
        if (@$_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%'";
        } else {
            $kondisi_search = "id_mstr != ''";
        }


        if (@$_POST['length'] != -1);
        $builder = $this->db->table('db_mstr')->where('TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) >=', 60);
        $query = $builder->select('*')
            ->where($kondisi_search)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->limit(@$_POST['length'], @$_POST['start'])
            ->get();
        return $query->getResult();
    }

    function count_filtered_lansia()
    {
        if (@$_POST['search']['value']) {
            $search = @$_POST['search']['value'];
            $kondisi_search = "AND (nik LIKE '%$search%' OR nkk LIKE '%$search%' OR nama LIKE '%$search%' OR jekel LIKE '%$search%')";
        } else {
            $kondisi_search = "";
        }

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr != '' $kondisi_search AND stts_hidup IN ('Ada', 'Masuk', 'Lahir') AND TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) >= 60";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }

    function count_all_lansia()
    {

        $sQuery = "SELECT COUNT(id_mstr) as jml FROM db_mstr WHERE id_mstr AND stts_hidup IN ('Ada', 'Masuk', 'Lahir') AND TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) >= 60";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();


        return $query;
    }
}
