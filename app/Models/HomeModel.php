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
    public function get_lk()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.jekel', 'LK')

            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->countAllResults();
    }
    public function get_laki()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.jekel', 'LK')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->get()->getResultArray();
    }
    public function get_pr()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.jekel', 'PR')

            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->countAllResults();
    }
    public function get_perempuan()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.jekel', 'PR')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->get()->getResultArray();
    }
    public function get_kk()
    {
        return $this->db->table('db_mstr')

            ->where('db_mstr.id_hub', 1)

            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->countAllResults();
    }
    public function get_sarilamak_kk()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.jorong', 'Sarilamak')
            ->where('db_mstr.id_hub', 1)

            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->countAllResults();
    }
    public function get_kk_sarilamak()
    {
        return $this->db->table('db_kk')

            ->join('db_mstr', 'db_mstr.id_hub = db_kk.id_hub')
            ->where('db_mstr.jorong', 'Sarilamak')
            ->where('db_mstr.id_hub', 1)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->get()->getResultArray();
    }


    public function get_purwajaya_kk()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.jorong', 'purwajaya')
            ->where('db_mstr.id_hub', 1)

            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->countAllResults();
    }

    public function get_kk_purwajaya()
    {
        return $this->db->table('db_kk')

            ->join('db_mstr', 'db_mstr.id_hub = db_kk.id_hub')
            ->where('db_mstr.jorong', 'Purwajaya')
            ->where('db_mstr.id_hub', 1)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->get()->getResultArray();
    }

    public function get_ketinggian_kk()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.jorong', 'ketinggian')
            ->where('db_mstr.id_hub', 1)

            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->countAllResults();
    }

    public function get_kk_ketinggian()
    {
        return $this->db->table('db_kk')

            ->join('db_mstr', 'db_mstr.id_hub = db_kk.id_hub')
            ->where('db_mstr.jorong', 'ketinggian')
            ->where('db_mstr.id_hub', 1)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->get()->getResultArray();
    }

    public function get_air_putih_kk()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.jorong', 'Air Putih')
            ->where('db_mstr.id_hub', 1)

            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->countAllResults();
    }

    public function get_kk_air_putih()
    {
        return $this->db->table('db_kk')

            ->join('db_mstr', 'db_mstr.id_hub = db_kk.id_hub')
            ->where('db_mstr.jorong', 'Air Putih')
            ->where('db_mstr.id_hub', 1)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->get()->getResultArray();
    }

    public function get_buluh_kasok_kk()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.jorong', 'Buluh Kasok')
            ->where('db_mstr.id_hub', 1)

            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->countAllResults();
    }

    public function get_kk_buluh_kasok()
    {
        return $this->db->table('db_kk')

            ->join('db_mstr', 'db_mstr.id_hub = db_kk.id_hub')
            ->where('db_mstr.jorong', 'Buluh Kasok')
            ->where('db_mstr.id_hub', 1)
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])
            ->get()->getResultArray();
    }


    public function get_sarilamak()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.jorong', 'Sarilamak')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->countAllResults();
    }

    public function get_sarilamak_p()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.jorong', 'Sarilamak')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->get()->getResultArray();
    }

    public function get_purwajaya()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.jorong', 'purwajaya')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->countAllResults();
    }

    public function get_purwajaya_p()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.jorong', 'purwajaya')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->get()->getResultArray();
    }

    public function get_ketinggian()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.jorong', 'ketinggian')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->countAllResults();
    }

    public function get_ketinggian_p()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.jorong', 'ketinggian')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->get()->getResultArray();
    }

    public function get_air_putih()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.jorong', 'air putih')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->countAllResults();
    }

    public function get_air_putih_p()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.jorong', 'air putih')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->get()->getResultArray();
    }

    public function get_buluh_kasok()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.jorong', 'buluh kasok')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->countAllResults();
    }

    public function get_buluh_kasok_p()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.jorong', 'buluh kasok')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->get()->getResultArray();
    }



    public function get_agama_islam()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.agama', 'islam')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->countAllResults();
    }

    public function get_agama_islam_p()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.agama', 'islam')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->get()->getResultArray();
    }

    public function get_agama_protestan()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.agama', 'protestan')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->countAllResults();
    }

    public function get_agama_protestan_p()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.agama', 'protestan')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->get()->getResultArray();
    }

    public function get_agama_katolik()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.agama', 'katolik')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->countAllResults();
    }

    public function get_agama_katolik_p()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.agama', 'katolik')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->get()->getResultArray();
    }

    public function get_agama_hindu()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.agama', 'hindu')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->countAllResults();
    }

    public function get_agama_hindu_p()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.agama', 'hindu')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->get()->getResultArray();
    }

    public function get_agama_buddha()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.agama', 'buddha')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->countAllResults();
    }

    public function get_agama_buddha_p()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.agama', 'buddha')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->get()->getResultArray();
    }

    public function get_agama_konghucu()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.agama', 'kong hu cu')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->countAllResults();
    }

    public function get_agama_konghucu_p()
    {
        return $this->db->table('db_mstr')
            ->where('db_mstr.agama', 'kong hu cu')
            ->whereIn('db_mstr.stts_hidup', ['Ada', 'Masuk', 'Lahir'])

            ->get()->getResultArray();
    }
}
