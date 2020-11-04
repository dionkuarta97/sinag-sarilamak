<?php



namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\HomeModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class Home extends BaseController
{

	protected $HomeModel;
	public function __construct()
	{
		$this->HomeModel = new HomeModel();
	}

	public function index()
	{
		$jumlah_semua_laki = $this->HomeModel->count_all_laki();
		$jumlah_semua_perempuan = $this->HomeModel->count_all_perempuan();

		$jumlah_kk_sarilamak = $this->HomeModel->count_all_kk_sarilamak();
		$jumlah_kk_purwajaya = $this->HomeModel->count_all_kk_purwajaya();
		$jumlah_kk_ketinggian = $this->HomeModel->count_all_kk_ketinggian();
		$jumlah_kk_air_putih = $this->HomeModel->count_all_kk_air_putih();
		$jumlah_kk_buluh_kasok = $this->HomeModel->count_all_kk_buluh_kasok();

		$jumlah_sarilamak = $this->HomeModel->count_all_sarilamak();
		$jumlah_purwajaya = $this->HomeModel->count_all_purwajaya();
		$jumlah_ketinggian = $this->HomeModel->count_all_ketinggian();
		$jumlah_air_putih = $this->HomeModel->count_all_air_putih();
		$jumlah_buluh_kasok = $this->HomeModel->count_all_buluh_kasok();

		$jumlah_islam = $this->HomeModel->count_all_islam();
		$jumlah_protestan = $this->HomeModel->count_all_protestan();
		$jumlah_katolik = $this->HomeModel->count_all_katolik();
		$jumlah_buddha = $this->HomeModel->count_all_buddha();
		$jumlah_hindu = $this->HomeModel->count_all_hindu();
		$jumlah_konghucu = $this->HomeModel->count_all_konghucu();

		$jumlah_stunting = $this->HomeModel->count_all_stunting();
		$jumlah_balita = $this->HomeModel->count_all_balita();
		$jumlah_anak_anak = $this->HomeModel->count_all_anak_anak();
		$jumlah_remaja = $this->HomeModel->count_all_remaja();
		$jumlah_dewasa = $this->HomeModel->count_all_dewasa();
		$jumlah_lansia = $this->HomeModel->count_all_lansia();

		$data = [
			'tittle' => 'Halaman Utama',
			'isi' => 'v_home',
			'jml_penduduk' => $this->HomeModel->get_all(),
			'jml_lk' => $jumlah_semua_laki->jml,
			'jml_pr' => $jumlah_semua_perempuan->jml,
			'jml_kk' => $this->HomeModel->get_kk(),

			'jml_sarilamak_kk' => $jumlah_kk_sarilamak->jml,
			'jml_purwajaya_kk' => $jumlah_kk_purwajaya->jml,
			'jml_ketinggian_kk' => $jumlah_kk_ketinggian->jml,
			'jml_air_putih_kk' => $jumlah_kk_air_putih->jml,
			'jml_buluh_kasok_kk' => $jumlah_kk_buluh_kasok->jml,

			'jml_purwajaya' => $jumlah_sarilamak->jml,
			'jml_sarilamak' =>  $jumlah_purwajaya->jml,
			'jml_ketinggian' =>  $jumlah_ketinggian->jml,
			'jml_air_putih' =>  $jumlah_air_putih->jml,
			'jml_buluh_kasok' =>  $jumlah_buluh_kasok->jml,

			'agama_islam' => $jumlah_islam->jml,
			'agama_protestan' => $jumlah_protestan->jml,
			'agama_katolik' => $jumlah_katolik->jml,
			'agama_hindu' => $jumlah_hindu->jml,
			'agama_buddha' => $jumlah_buddha->jml,
			'agama_konghucu' => $jumlah_konghucu->jml,

			'stunting' => $jumlah_stunting->jml,
			'balita' => $jumlah_balita->jml,
			'anak_anak' => $jumlah_anak_anak->jml,
			'remaja' => $jumlah_remaja->jml,
			'dewasa' => $jumlah_dewasa->jml,
			'lansia' => $jumlah_lansia->jml,

		];
		echo view('layout/v_wrapper', $data);
	}


	public function jml_lk()
	{
		$data = [
			'tittle' => 'Penduduk Laki Laki',
			'isi' => 'Datapenduduk/v_laki',

		];
		echo view('layout/v_wrapper', $data);
	}

	public function jquery_master_laki()
	{
		$listing = $this->HomeModel->get_datatables_laki();
		$jumlah_semua = $this->HomeModel->count_all_laki();
		$jumlah_filter = $this->HomeModel->count_filtered_laki();

		$data = array();
		$no = @$_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<a href="' . site_url('Datamaster/delete/' . $key->id_mstr) . '" onclick="return confirm(\'Yakin....?\')" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i></a>
            <a href="' . site_url('Datamaster/detail/' . $key->id_mstr) . '" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>';
			$row[] = $key->nik;
			$row[] = $key->nkk;
			$row[] = $key->nama;
			$row[] = tanggal_indo($key->tgl_lahir);
			$row[] = hitung_umur($key->tgl_lahir);
			$row[] = $key->agama;
			$row[] = $key->jekel;
			$row[] = $key->pekerjaan;
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsFiltered" => $jumlah_filter->jml,
			"recordsTotal" => $jumlah_semua->jml,
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function excel_laki()
	{
		$data['db_mstr'] =  $this->HomeModel->get_laki();


		$spreadsheet = new Spreadsheet;

		$spreadsheet->getProperties()->setCreator("Dion Kuarta");
		$spreadsheet->getProperties()->setLastModifiedBy("Dion Kuarta");

		$spreadsheet->getProperties()->setTitle("Data Laki");
		$spreadsheet->getActiveSheetIndex(0);



		$spreadsheet->getActiveSheet()->setCellValue('A1', 'NO');
		$spreadsheet->getActiveSheet()->setCellValue('B1', 'NIK');
		$spreadsheet->getActiveSheet()->setCellValue('C1', 'NKK');
		$spreadsheet->getActiveSheet()->setCellValue('D1', 'NAMA');
		$spreadsheet->getActiveSheet()->setCellValue('E1', 'TANGGAL LAHIR');
		$spreadsheet->getActiveSheet()->setCellValue('F1', 'UMUR');
		$spreadsheet->getActiveSheet()->setCellValue('G1', 'AGAMA');
		$spreadsheet->getActiveSheet()->setCellValue('H1', 'JENIS KELAMIN');
		$spreadsheet->getActiveSheet()->setCellValue('I1', 'PEKERJAAN');

		$baris = 2;
		$no = 1;

		foreach ($data['db_mstr'] as $mstr) {

			$spreadsheet->getActiveSheet()->setCellValue('A' . $baris, $no++);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('B' . $baris, $mstr['nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('C' . $baris, $mstr['nkk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValue('D' . $baris, $mstr['nama']);
			$spreadsheet->getActiveSheet()->setCellValue('E' . $baris, tanggal_indo($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('F' . $baris, hitung_umur($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('G' . $baris, $mstr['agama']);
			$spreadsheet->getActiveSheet()->setCellValue('H' . $baris, $mstr['jekel']);
			$spreadsheet->getActiveSheet()->setCellValue('I' . $baris, $mstr['pekerjaan']);

			$baris++;
		}



		$spreadsheet->getActiveSheet()->setTitle("Data Laki");
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_laki.Xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);

		$writer->save('php://output');

		exit;
	}


	public function jml_pr()
	{
		$data = [
			'tittle' => 'Penduduk Perempuan',
			'isi' => 'Datapenduduk/v_perempuan',

		];
		echo view('layout/v_wrapper', $data);
	}


	public function jquery_master_perempuan()
	{
		$listing = $this->HomeModel->get_datatables_perempuan();
		$jumlah_semua = $this->HomeModel->count_all_perempuan();
		$jumlah_filter = $this->HomeModel->count_filtered_perempuan();

		$data = array();
		$no = @$_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<a href="' . site_url('Datamaster/delete/' . $key->id_mstr) . '" onclick="return confirm(\'Yakin....?\')" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i></a>
            <a href="' . site_url('Datamaster/detail/' . $key->id_mstr) . '" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>';
			$row[] = $key->nik;
			$row[] = $key->nkk;
			$row[] = $key->nama;
			$row[] = tanggal_indo($key->tgl_lahir);
			$row[] = hitung_umur($key->tgl_lahir);
			$row[] = $key->agama;
			$row[] = $key->jekel;
			$row[] = $key->pekerjaan;
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsFiltered" => $jumlah_filter->jml,
			"recordsTotal" => $jumlah_semua->jml,
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function excel_pr()
	{
		$data['db_mstr'] =  $this->HomeModel->get_perempuan();


		$spreadsheet = new Spreadsheet;

		$spreadsheet->getProperties()->setCreator("Dion Kuarta");
		$spreadsheet->getProperties()->setLastModifiedBy("Dion Kuarta");

		$spreadsheet->getProperties()->setTitle("Data Perempuan");
		$spreadsheet->getActiveSheetIndex(0);



		$spreadsheet->getActiveSheet()->setCellValue('A1', 'NO');
		$spreadsheet->getActiveSheet()->setCellValue('B1', 'NIK');
		$spreadsheet->getActiveSheet()->setCellValue('C1', 'NKK');
		$spreadsheet->getActiveSheet()->setCellValue('D1', 'NAMA');
		$spreadsheet->getActiveSheet()->setCellValue('E1', 'TANGGAL LAHIR');
		$spreadsheet->getActiveSheet()->setCellValue('F1', 'UMUR');
		$spreadsheet->getActiveSheet()->setCellValue('G1', 'AGAMA');
		$spreadsheet->getActiveSheet()->setCellValue('H1', 'JENIS KELAMIN');
		$spreadsheet->getActiveSheet()->setCellValue('I1', 'PEKERJAAN');

		$baris = 2;
		$no = 1;

		foreach ($data['db_mstr'] as $mstr) {

			$spreadsheet->getActiveSheet()->setCellValue('A' . $baris, $no++);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('B' . $baris, $mstr['nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('C' . $baris, $mstr['nkk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValue('D' . $baris, $mstr['nama']);
			$spreadsheet->getActiveSheet()->setCellValue('E' . $baris, tanggal_indo($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('F' . $baris, hitung_umur($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('G' . $baris, $mstr['agama']);
			$spreadsheet->getActiveSheet()->setCellValue('H' . $baris, $mstr['jekel']);
			$spreadsheet->getActiveSheet()->setCellValue('I' . $baris, $mstr['pekerjaan']);

			$baris++;
		}



		$spreadsheet->getActiveSheet()->setTitle("Data Perempuan");
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_Perempuan.Xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);

		$writer->save('php://output');

		exit;
	}

	public function jml_kk_sarilamak()
	{
		$data = [
			'tittle' => 'Sarilamak Keluarga',
			'isi' => 'Datapenduduk/v_kk_sarilamak',

		];
		echo view('layout/v_wrapper', $data);
	}

	public function jquery_master_kk_sarilamak()
	{
		$listing = $this->HomeModel->get_datatables_kk_sarilamak();
		$jumlah_semua = $this->HomeModel->count_all_kk_sarilamak();
		$jumlah_filter = $this->HomeModel->count_filtered_kk_sarilamak();


		$data = array();
		$no = @$_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<a href="' . site_url('Datakk/detail/' . $key->nkk) . '" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>';
			$row[] = $key->nkk;
			$row[] = $key->nama;
			$row[] = $key->hubungan;
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsFiltered" => $jumlah_filter->jml,
			"recordsTotal" => $jumlah_semua->jml,
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function excel_kk_sarilamak()
	{
		$data['db_kk'] =  $this->HomeModel->get_kk_sarilamak();


		$spreadsheet = new Spreadsheet;

		$spreadsheet->getProperties()->setCreator("Dion Kuarta");
		$spreadsheet->getProperties()->setLastModifiedBy("Dion Kuarta");

		$spreadsheet->getProperties()->setTitle("Data KK Sarilamak");
		$spreadsheet->getActiveSheetIndex(0);



		$spreadsheet->getActiveSheet()->setCellValue('A1', 'NO');
		$spreadsheet->getActiveSheet()->setCellValue('B1', 'NKK');
		$spreadsheet->getActiveSheet()->setCellValue('C1', 'NAMA');
		$spreadsheet->getActiveSheet()->setCellValue('D1', 'HUBUNGAN');


		$baris = 2;
		$no = 1;

		foreach ($data['db_kk'] as $mstr) {

			$spreadsheet->getActiveSheet()->setCellValue('A' . $baris, $no++);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('B' . $baris, $mstr['nkk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValue('C' . $baris, $mstr['nama']);
			$spreadsheet->getActiveSheet()->setCellValue('D' . $baris, $mstr['hubungan']);


			$baris++;
		}



		$spreadsheet->getActiveSheet()->setTitle("Data KK Sarilamak");
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_KK_Sarilamak.Xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);

		$writer->save('php://output');

		exit;
	}

	public function jml_kk_purwajaya()
	{
		$data = [
			'tittle' => 'Purwajaya Keluarga',
			'isi' => 'Datapenduduk/v_kk_purwajaya',

		];
		echo view('layout/v_wrapper', $data);
	}

	public function jquery_master_kk_purwajaya()
	{
		$listing = $this->HomeModel->get_datatables_kk_purwajaya();
		$jumlah_semua = $this->HomeModel->count_all_kk_purwajaya();
		$jumlah_filter = $this->HomeModel->count_filtered_kk_purwajaya();


		$data = array();
		$no = @$_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<a href="' . site_url('Datakk/detail/' . $key->nkk) . '" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>';
			$row[] = $key->nkk;
			$row[] = $key->nama;
			$row[] = $key->hubungan;
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsFiltered" => $jumlah_filter->jml,
			"recordsTotal" => $jumlah_semua->jml,
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function excel_kk_purwajaya()
	{
		$data['db_kk'] =  $this->HomeModel->get_kk_purwajaya();


		$spreadsheet = new Spreadsheet;

		$spreadsheet->getProperties()->setCreator("Dion Kuarta");
		$spreadsheet->getProperties()->setLastModifiedBy("Dion Kuarta");

		$spreadsheet->getProperties()->setTitle("Data KK purwajaya");
		$spreadsheet->getActiveSheetIndex(0);



		$spreadsheet->getActiveSheet()->setCellValue('A1', 'NO');
		$spreadsheet->getActiveSheet()->setCellValue('B1', 'NKK');
		$spreadsheet->getActiveSheet()->setCellValue('C1', 'NAMA');
		$spreadsheet->getActiveSheet()->setCellValue('D1', 'HUBUNGAN');


		$baris = 2;
		$no = 1;

		foreach ($data['db_kk'] as $mstr) {

			$spreadsheet->getActiveSheet()->setCellValue('A' . $baris, $no++);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('B' . $baris, $mstr['nkk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValue('C' . $baris, $mstr['nama']);
			$spreadsheet->getActiveSheet()->setCellValue('D' . $baris, $mstr['hubungan']);


			$baris++;
		}



		$spreadsheet->getActiveSheet()->setTitle("Data KK purwajaya");
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_KK_purwajaya.Xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);

		$writer->save('php://output');

		exit;
	}

	public function jml_kk_ketinggian()
	{
		$data = [
			'tittle' => 'Ketinggian Keluarga',
			'isi' => 'Datapenduduk/v_kk_ketinggian',

		];
		echo view('layout/v_wrapper', $data);
	}


	public function jquery_master_kk_ketinggian()
	{
		$listing = $this->HomeModel->get_datatables_kk_ketinggian();
		$jumlah_semua = $this->HomeModel->count_all_kk_ketinggian();
		$jumlah_filter = $this->HomeModel->count_filtered_kk_ketinggian();


		$data = array();
		$no = @$_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<a href="' . site_url('Datakk/detail/' . $key->nkk) . '" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>';
			$row[] = $key->nkk;
			$row[] = $key->nama;
			$row[] = $key->hubungan;
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsFiltered" => $jumlah_filter->jml,
			"recordsTotal" => $jumlah_semua->jml,
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}


	public function excel_kk_ketinggian()
	{
		$data['db_kk'] =  $this->HomeModel->get_kk_ketinggian();


		$spreadsheet = new Spreadsheet;

		$spreadsheet->getProperties()->setCreator("Dion Kuarta");
		$spreadsheet->getProperties()->setLastModifiedBy("Dion Kuarta");

		$spreadsheet->getProperties()->setTitle("Data KK ketinggian");
		$spreadsheet->getActiveSheetIndex(0);



		$spreadsheet->getActiveSheet()->setCellValue('A1', 'NO');
		$spreadsheet->getActiveSheet()->setCellValue('B1', 'NKK');
		$spreadsheet->getActiveSheet()->setCellValue('C1', 'NAMA');
		$spreadsheet->getActiveSheet()->setCellValue('D1', 'HUBUNGAN');


		$baris = 2;
		$no = 1;

		foreach ($data['db_kk'] as $mstr) {

			$spreadsheet->getActiveSheet()->setCellValue('A' . $baris, $no++);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('B' . $baris, $mstr['nkk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValue('C' . $baris, $mstr['nama']);
			$spreadsheet->getActiveSheet()->setCellValue('D' . $baris, $mstr['hubungan']);


			$baris++;
		}



		$spreadsheet->getActiveSheet()->setTitle("Data KK ketinggian");
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_KK_ketinggian.Xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);

		$writer->save('php://output');

		exit;
	}

	public function jml_kk_air_putih()
	{
		$data = [
			'tittle' => 'Ketinggian Air Putih',
			'isi' => 'Datapenduduk/v_kk_air_putih',

		];
		echo view('layout/v_wrapper', $data);
	}


	public function jquery_master_kk_air_putih()
	{
		$listing = $this->HomeModel->get_datatables_kk_air_putih();
		$jumlah_semua = $this->HomeModel->count_all_kk_air_putih();
		$jumlah_filter = $this->HomeModel->count_filtered_kk_air_putih();


		$data = array();
		$no = @$_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<a href="' . site_url('Datakk/detail/' . $key->nkk) . '" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>';
			$row[] = $key->nkk;
			$row[] = $key->nama;
			$row[] = $key->hubungan;
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsFiltered" => $jumlah_filter->jml,
			"recordsTotal" => $jumlah_semua->jml,
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function excel_kk_air_putih()
	{
		$data['db_kk'] =  $this->HomeModel->get_kk_air_putih();


		$spreadsheet = new Spreadsheet;

		$spreadsheet->getProperties()->setCreator("Dion Kuarta");
		$spreadsheet->getProperties()->setLastModifiedBy("Dion Kuarta");

		$spreadsheet->getProperties()->setTitle("Data KK Air Putih");
		$spreadsheet->getActiveSheetIndex(0);



		$spreadsheet->getActiveSheet()->setCellValue('A1', 'NO');
		$spreadsheet->getActiveSheet()->setCellValue('B1', 'NKK');
		$spreadsheet->getActiveSheet()->setCellValue('C1', 'NAMA');
		$spreadsheet->getActiveSheet()->setCellValue('D1', 'HUBUNGAN');


		$baris = 2;
		$no = 1;

		foreach ($data['db_kk'] as $mstr) {

			$spreadsheet->getActiveSheet()->setCellValue('A' . $baris, $no++);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('B' . $baris, $mstr['nkk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValue('C' . $baris, $mstr['nama']);
			$spreadsheet->getActiveSheet()->setCellValue('D' . $baris, $mstr['hubungan']);


			$baris++;
		}



		$spreadsheet->getActiveSheet()->setTitle("Data KK Air Putih");
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_KK_Air_Putih.Xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);

		$writer->save('php://output');

		exit;
	}

	public function jml_kk_buluh_kasok()
	{
		$data = [
			'tittle' => 'Ketinggian Buluh Kasok',
			'isi' => 'Datapenduduk/v_kk_buluh_kasok',

		];
		echo view('layout/v_wrapper', $data);
	}

	public function jquery_master_kk_buluh_kasok()
	{
		$listing = $this->HomeModel->get_datatables_kk_buluh_kasok();
		$jumlah_semua = $this->HomeModel->count_all_kk_buluh_kasok();
		$jumlah_filter = $this->HomeModel->count_filtered_kk_buluh_kasok();


		$data = array();
		$no = @$_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<a href="' . site_url('Datakk/detail/' . $key->nkk) . '" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>';
			$row[] = $key->nkk;
			$row[] = $key->nama;
			$row[] = $key->hubungan;
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsFiltered" => $jumlah_filter->jml,
			"recordsTotal" => $jumlah_semua->jml,
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function excel_kk_buluh_kasok()
	{
		$data['db_kk'] =  $this->HomeModel->get_kk_buluh_kasok();


		$spreadsheet = new Spreadsheet;

		$spreadsheet->getProperties()->setCreator("Dion Kuarta");
		$spreadsheet->getProperties()->setLastModifiedBy("Dion Kuarta");

		$spreadsheet->getProperties()->setTitle("Data KK Buluh Kasok");
		$spreadsheet->getActiveSheetIndex(0);



		$spreadsheet->getActiveSheet()->setCellValue('A1', 'NO');
		$spreadsheet->getActiveSheet()->setCellValue('B1', 'NKK');
		$spreadsheet->getActiveSheet()->setCellValue('C1', 'NAMA');
		$spreadsheet->getActiveSheet()->setCellValue('D1', 'HUBUNGAN');


		$baris = 2;
		$no = 1;

		foreach ($data['db_kk'] as $mstr) {

			$spreadsheet->getActiveSheet()->setCellValue('A' . $baris, $no++);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('B' . $baris, $mstr['nkk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValue('C' . $baris, $mstr['nama']);
			$spreadsheet->getActiveSheet()->setCellValue('D' . $baris, $mstr['hubungan']);


			$baris++;
		}



		$spreadsheet->getActiveSheet()->setTitle("Data KK Buluh Kasok");
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_KK_buluh_kasok.Xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);

		$writer->save('php://output');

		exit;
	}

	public function jml_sarilamak()
	{
		$data = [
			'tittle' => 'Penduduk Sarilamak',
			'isi' => 'Datapenduduk/v_sarilamak',

		];
		echo view('layout/v_wrapper', $data);
	}

	public function jquery_master_sarilamak()
	{
		$listing = $this->HomeModel->get_datatables_sarilamak();
		$jumlah_semua = $this->HomeModel->count_all_sarilamak();
		$jumlah_filter = $this->HomeModel->count_filtered_sarilamak();

		$data = array();
		$no = @$_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<a href="' . site_url('Datamaster/delete/' . $key->id_mstr) . '" onclick="return confirm(\'Yakin....?\')" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i></a>
            <a href="' . site_url('Datamaster/detail/' . $key->id_mstr) . '" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>';
			$row[] = $key->nik;
			$row[] = $key->nkk;
			$row[] = $key->nama;
			$row[] = tanggal_indo($key->tgl_lahir);
			$row[] = hitung_umur($key->tgl_lahir);
			$row[] = $key->agama;
			$row[] = $key->jekel;
			$row[] = $key->pekerjaan;
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsFiltered" => $jumlah_filter->jml,
			"recordsTotal" => $jumlah_semua->jml,
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function excel_sarilamak()
	{
		$data['db_mstr'] =  $this->HomeModel->get_sarilamak_p();


		$spreadsheet = new Spreadsheet;

		$spreadsheet->getProperties()->setCreator("Dion Kuarta");
		$spreadsheet->getProperties()->setLastModifiedBy("Dion Kuarta");

		$spreadsheet->getProperties()->setTitle("Data Sarilamak");
		$spreadsheet->getActiveSheetIndex(0);



		$spreadsheet->getActiveSheet()->setCellValue('A1', 'NO');
		$spreadsheet->getActiveSheet()->setCellValue('B1', 'NIK');
		$spreadsheet->getActiveSheet()->setCellValue('C1', 'NKK');
		$spreadsheet->getActiveSheet()->setCellValue('D1', 'NAMA');
		$spreadsheet->getActiveSheet()->setCellValue('E1', 'TANGGAL LAHIR');
		$spreadsheet->getActiveSheet()->setCellValue('F1', 'UMUR');
		$spreadsheet->getActiveSheet()->setCellValue('G1', 'AGAMA');
		$spreadsheet->getActiveSheet()->setCellValue('H1', 'JENIS KELAMIN');
		$spreadsheet->getActiveSheet()->setCellValue('I1', 'PEKERJAAN');

		$baris = 2;
		$no = 1;

		foreach ($data['db_mstr'] as $mstr) {

			$spreadsheet->getActiveSheet()->setCellValue('A' . $baris, $no++);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('B' . $baris, $mstr['nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('C' . $baris, $mstr['nkk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValue('D' . $baris, $mstr['nama']);
			$spreadsheet->getActiveSheet()->setCellValue('E' . $baris, tanggal_indo($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('F' . $baris, hitung_umur($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('G' . $baris, $mstr['agama']);
			$spreadsheet->getActiveSheet()->setCellValue('H' . $baris, $mstr['jekel']);
			$spreadsheet->getActiveSheet()->setCellValue('I' . $baris, $mstr['pekerjaan']);

			$baris++;
		}



		$spreadsheet->getActiveSheet()->setTitle("Data Sarilamak");
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_Sarilamak.Xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);

		$writer->save('php://output');

		exit;
	}

	public function jml_purwajaya()
	{
		$data = [
			'tittle' => 'Penduduk purwajaya',
			'isi' => 'Datapenduduk/v_purwajaya',

		];
		echo view('layout/v_wrapper', $data);
	}

	public function jquery_master_purwajaya()
	{
		$listing = $this->HomeModel->get_datatables_purwajaya();
		$jumlah_semua = $this->HomeModel->count_all_purwajaya();
		$jumlah_filter = $this->HomeModel->count_filtered_purwajaya();

		$data = array();
		$no = @$_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<a href="' . site_url('Datamaster/delete/' . $key->id_mstr) . '" onclick="return confirm(\'Yakin....?\')" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i></a>
            <a href="' . site_url('Datamaster/detail/' . $key->id_mstr) . '" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>';
			$row[] = $key->nik;
			$row[] = $key->nkk;
			$row[] = $key->nama;
			$row[] = tanggal_indo($key->tgl_lahir);
			$row[] = hitung_umur($key->tgl_lahir);
			$row[] = $key->agama;
			$row[] = $key->jekel;
			$row[] = $key->pekerjaan;
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsFiltered" => $jumlah_filter->jml,
			"recordsTotal" => $jumlah_semua->jml,
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function excel_purwajaya()
	{
		$data['db_mstr'] =  $this->HomeModel->get_purwajaya_p();


		$spreadsheet = new Spreadsheet;

		$spreadsheet->getProperties()->setCreator("Dion Kuarta");
		$spreadsheet->getProperties()->setLastModifiedBy("Dion Kuarta");

		$spreadsheet->getProperties()->setTitle("Data purwajaya");
		$spreadsheet->getActiveSheetIndex(0);



		$spreadsheet->getActiveSheet()->setCellValue('A1', 'NO');
		$spreadsheet->getActiveSheet()->setCellValue('B1', 'NIK');
		$spreadsheet->getActiveSheet()->setCellValue('C1', 'NKK');
		$spreadsheet->getActiveSheet()->setCellValue('D1', 'NAMA');
		$spreadsheet->getActiveSheet()->setCellValue('E1', 'TANGGAL LAHIR');
		$spreadsheet->getActiveSheet()->setCellValue('F1', 'UMUR');
		$spreadsheet->getActiveSheet()->setCellValue('G1', 'AGAMA');
		$spreadsheet->getActiveSheet()->setCellValue('H1', 'JENIS KELAMIN');
		$spreadsheet->getActiveSheet()->setCellValue('I1', 'PEKERJAAN');

		$baris = 2;
		$no = 1;

		foreach ($data['db_mstr'] as $mstr) {

			$spreadsheet->getActiveSheet()->setCellValue('A' . $baris, $no++);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('B' . $baris, $mstr['nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('C' . $baris, $mstr['nkk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValue('D' . $baris, $mstr['nama']);
			$spreadsheet->getActiveSheet()->setCellValue('E' . $baris, tanggal_indo($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('F' . $baris, hitung_umur($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('G' . $baris, $mstr['agama']);
			$spreadsheet->getActiveSheet()->setCellValue('H' . $baris, $mstr['jekel']);
			$spreadsheet->getActiveSheet()->setCellValue('I' . $baris, $mstr['pekerjaan']);

			$baris++;
		}



		$spreadsheet->getActiveSheet()->setTitle("Data purwajaya");
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_purwajaya.Xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);

		$writer->save('php://output');

		exit;
	}

	public function jml_ketinggian()
	{
		$data = [
			'tittle' => 'Penduduk ketinggian',
			'isi' => 'Datapenduduk/v_ketinggian',

		];
		echo view('layout/v_wrapper', $data);
	}

	public function jquery_master_ketinggian()
	{
		$listing = $this->HomeModel->get_datatables_ketinggian();
		$jumlah_semua = $this->HomeModel->count_all_ketinggian();
		$jumlah_filter = $this->HomeModel->count_filtered_ketinggian();

		$data = array();
		$no = @$_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<a href="' . site_url('Datamaster/delete/' . $key->id_mstr) . '" onclick="return confirm(\'Yakin....?\')" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i></a>
            <a href="' . site_url('Datamaster/detail/' . $key->id_mstr) . '" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>';
			$row[] = $key->nik;
			$row[] = $key->nkk;
			$row[] = $key->nama;
			$row[] = tanggal_indo($key->tgl_lahir);
			$row[] = hitung_umur($key->tgl_lahir);
			$row[] = $key->agama;
			$row[] = $key->jekel;
			$row[] = $key->pekerjaan;
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsFiltered" => $jumlah_filter->jml,
			"recordsTotal" => $jumlah_semua->jml,
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}


	public function excel_ketinggian()
	{
		$data['db_mstr'] =  $this->HomeModel->get_ketinggian_p();


		$spreadsheet = new Spreadsheet;

		$spreadsheet->getProperties()->setCreator("Dion Kuarta");
		$spreadsheet->getProperties()->setLastModifiedBy("Dion Kuarta");

		$spreadsheet->getProperties()->setTitle("Data ketinggiaan");
		$spreadsheet->getActiveSheetIndex(0);



		$spreadsheet->getActiveSheet()->setCellValue('A1', 'NO');
		$spreadsheet->getActiveSheet()->setCellValue('B1', 'NIK');
		$spreadsheet->getActiveSheet()->setCellValue('C1', 'NKK');
		$spreadsheet->getActiveSheet()->setCellValue('D1', 'NAMA');
		$spreadsheet->getActiveSheet()->setCellValue('E1', 'TANGGAL LAHIR');
		$spreadsheet->getActiveSheet()->setCellValue('F1', 'UMUR');
		$spreadsheet->getActiveSheet()->setCellValue('G1', 'AGAMA');
		$spreadsheet->getActiveSheet()->setCellValue('H1', 'JENIS KELAMIN');
		$spreadsheet->getActiveSheet()->setCellValue('I1', 'PEKERJAAN');

		$baris = 2;
		$no = 1;

		foreach ($data['db_mstr'] as $mstr) {

			$spreadsheet->getActiveSheet()->setCellValue('A' . $baris, $no++);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('B' . $baris, $mstr['nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('C' . $baris, $mstr['nkk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValue('D' . $baris, $mstr['nama']);
			$spreadsheet->getActiveSheet()->setCellValue('E' . $baris, tanggal_indo($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('F' . $baris, hitung_umur($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('G' . $baris, $mstr['agama']);
			$spreadsheet->getActiveSheet()->setCellValue('H' . $baris, $mstr['jekel']);
			$spreadsheet->getActiveSheet()->setCellValue('I' . $baris, $mstr['pekerjaan']);

			$baris++;
		}



		$spreadsheet->getActiveSheet()->setTitle("Data ketinggian");
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_ketinggian.Xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);

		$writer->save('php://output');

		exit;
	}

	public function jml_air_putih()
	{
		$data = [
			'tittle' => 'Penduduk air_putih',
			'isi' => 'Datapenduduk/v_air_putih',

		];
		echo view('layout/v_wrapper', $data);
	}

	public function jquery_master_air_putih()
	{
		$listing = $this->HomeModel->get_datatables_air_putih();
		$jumlah_semua = $this->HomeModel->count_all_air_putih();
		$jumlah_filter = $this->HomeModel->count_filtered_air_putih();

		$data = array();
		$no = @$_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<a href="' . site_url('Datamaster/delete/' . $key->id_mstr) . '" onclick="return confirm(\'Yakin....?\')" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i></a>
            <a href="' . site_url('Datamaster/detail/' . $key->id_mstr) . '" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>';
			$row[] = $key->nik;
			$row[] = $key->nkk;
			$row[] = $key->nama;
			$row[] = tanggal_indo($key->tgl_lahir);
			$row[] = hitung_umur($key->tgl_lahir);
			$row[] = $key->agama;
			$row[] = $key->jekel;
			$row[] = $key->pekerjaan;
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsFiltered" => $jumlah_filter->jml,
			"recordsTotal" => $jumlah_semua->jml,
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function excel_air_putih()
	{
		$data['db_mstr'] =  $this->HomeModel->get_air_putih_p();


		$spreadsheet = new Spreadsheet;

		$spreadsheet->getProperties()->setCreator("Dion Kuarta");
		$spreadsheet->getProperties()->setLastModifiedBy("Dion Kuarta");

		$spreadsheet->getProperties()->setTitle("Data air_putih");
		$spreadsheet->getActiveSheetIndex(0);



		$spreadsheet->getActiveSheet()->setCellValue('A1', 'NO');
		$spreadsheet->getActiveSheet()->setCellValue('B1', 'NIK');
		$spreadsheet->getActiveSheet()->setCellValue('C1', 'NKK');
		$spreadsheet->getActiveSheet()->setCellValue('D1', 'NAMA');
		$spreadsheet->getActiveSheet()->setCellValue('E1', 'TANGGAL LAHIR');
		$spreadsheet->getActiveSheet()->setCellValue('F1', 'UMUR');
		$spreadsheet->getActiveSheet()->setCellValue('G1', 'AGAMA');
		$spreadsheet->getActiveSheet()->setCellValue('H1', 'JENIS KELAMIN');
		$spreadsheet->getActiveSheet()->setCellValue('I1', 'PEKERJAAN');

		$baris = 2;
		$no = 1;

		foreach ($data['db_mstr'] as $mstr) {

			$spreadsheet->getActiveSheet()->setCellValue('A' . $baris, $no++);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('B' . $baris, $mstr['nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('C' . $baris, $mstr['nkk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValue('D' . $baris, $mstr['nama']);
			$spreadsheet->getActiveSheet()->setCellValue('E' . $baris, tanggal_indo($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('F' . $baris, hitung_umur($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('G' . $baris, $mstr['agama']);
			$spreadsheet->getActiveSheet()->setCellValue('H' . $baris, $mstr['jekel']);
			$spreadsheet->getActiveSheet()->setCellValue('I' . $baris, $mstr['pekerjaan']);

			$baris++;
		}



		$spreadsheet->getActiveSheet()->setTitle("Data air_putih");
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_air_putih.Xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);

		$writer->save('php://output');

		exit;
	}

	public function jml_buluh_kasok()
	{
		$data = [
			'tittle' => 'Penduduk buluh_kasok',
			'isi' => 'Datapenduduk/v_buluh_kasok',

		];
		echo view('layout/v_wrapper', $data);
	}

	public function jquery_master_buluh_kasok()
	{
		$listing = $this->HomeModel->get_datatables_buluh_kasok();
		$jumlah_semua = $this->HomeModel->count_all_buluh_kasok();
		$jumlah_filter = $this->HomeModel->count_filtered_buluh_kasok();

		$data = array();
		$no = @$_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<a href="' . site_url('Datamaster/delete/' . $key->id_mstr) . '" onclick="return confirm(\'Yakin....?\')" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i></a>
            <a href="' . site_url('Datamaster/detail/' . $key->id_mstr) . '" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>';
			$row[] = $key->nik;
			$row[] = $key->nkk;
			$row[] = $key->nama;
			$row[] = tanggal_indo($key->tgl_lahir);
			$row[] = hitung_umur($key->tgl_lahir);
			$row[] = $key->agama;
			$row[] = $key->jekel;
			$row[] = $key->pekerjaan;
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsFiltered" => $jumlah_filter->jml,
			"recordsTotal" => $jumlah_semua->jml,
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function excel_buluh_kasok()
	{
		$data['db_mstr'] =  $this->HomeModel->get_buluh_kasok_p();


		$spreadsheet = new Spreadsheet;

		$spreadsheet->getProperties()->setCreator("Dion Kuarta");
		$spreadsheet->getProperties()->setLastModifiedBy("Dion Kuarta");

		$spreadsheet->getProperties()->setTitle("Data buluh_kasok");
		$spreadsheet->getActiveSheetIndex(0);



		$spreadsheet->getActiveSheet()->setCellValue('A1', 'NO');
		$spreadsheet->getActiveSheet()->setCellValue('B1', 'NIK');
		$spreadsheet->getActiveSheet()->setCellValue('C1', 'NKK');
		$spreadsheet->getActiveSheet()->setCellValue('D1', 'NAMA');
		$spreadsheet->getActiveSheet()->setCellValue('E1', 'TANGGAL LAHIR');
		$spreadsheet->getActiveSheet()->setCellValue('F1', 'UMUR');
		$spreadsheet->getActiveSheet()->setCellValue('G1', 'AGAMA');
		$spreadsheet->getActiveSheet()->setCellValue('H1', 'JENIS KELAMIN');
		$spreadsheet->getActiveSheet()->setCellValue('I1', 'PEKERJAAN');

		$baris = 2;
		$no = 1;

		foreach ($data['db_mstr'] as $mstr) {

			$spreadsheet->getActiveSheet()->setCellValue('A' . $baris, $no++);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('B' . $baris, $mstr['nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('C' . $baris, $mstr['nkk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValue('D' . $baris, $mstr['nama']);
			$spreadsheet->getActiveSheet()->setCellValue('E' . $baris, tanggal_indo($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('F' . $baris, hitung_umur($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('G' . $baris, $mstr['agama']);
			$spreadsheet->getActiveSheet()->setCellValue('H' . $baris, $mstr['jekel']);
			$spreadsheet->getActiveSheet()->setCellValue('I' . $baris, $mstr['pekerjaan']);

			$baris++;
		}



		$spreadsheet->getActiveSheet()->setTitle("Data buluh_kasok");
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_buluh_kasok.Xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);

		$writer->save('php://output');

		exit;
	}

	public function agama_islam()
	{
		$data = [
			'tittle' => 'Penduduk Agama Islam',
			'isi' => 'Agama/v_islam',

		];
		echo view('layout/v_wrapper', $data);
	}

	public function jquery_master_islam()
	{
		$listing = $this->HomeModel->get_datatables_islam();
		$jumlah_semua = $this->HomeModel->count_all_islam();
		$jumlah_filter = $this->HomeModel->count_filtered_islam();

		$data = array();
		$no = @$_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<a href="' . site_url('Datamaster/delete/' . $key->id_mstr) . '" onclick="return confirm(\'Yakin....?\')" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i></a>
            <a href="' . site_url('Datamaster/detail/' . $key->id_mstr) . '" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>';
			$row[] = $key->nik;
			$row[] = $key->nkk;
			$row[] = $key->nama;
			$row[] = tanggal_indo($key->tgl_lahir);
			$row[] = hitung_umur($key->tgl_lahir);
			$row[] = $key->agama;
			$row[] = $key->jekel;
			$row[] = $key->pekerjaan;
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsFiltered" => $jumlah_filter->jml,
			"recordsTotal" => $jumlah_semua->jml,
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function excel_islam()
	{
		$data['db_mstr'] =  $this->HomeModel->get_agama_islam_p();


		$spreadsheet = new Spreadsheet;

		$spreadsheet->getProperties()->setCreator("Dion Kuarta");
		$spreadsheet->getProperties()->setLastModifiedBy("Dion Kuarta");

		$spreadsheet->getProperties()->setTitle("Data Agama Islam");
		$spreadsheet->getActiveSheetIndex(0);



		$spreadsheet->getActiveSheet()->setCellValue('A1', 'NO');
		$spreadsheet->getActiveSheet()->setCellValue('B1', 'NIK');
		$spreadsheet->getActiveSheet()->setCellValue('C1', 'NKK');
		$spreadsheet->getActiveSheet()->setCellValue('D1', 'NAMA');
		$spreadsheet->getActiveSheet()->setCellValue('E1', 'TANGGAL LAHIR');
		$spreadsheet->getActiveSheet()->setCellValue('F1', 'UMUR');
		$spreadsheet->getActiveSheet()->setCellValue('G1', 'AGAMA');
		$spreadsheet->getActiveSheet()->setCellValue('H1', 'JENIS KELAMIN');
		$spreadsheet->getActiveSheet()->setCellValue('I1', 'PEKERJAAN');

		$baris = 2;
		$no = 1;

		foreach ($data['db_mstr'] as $mstr) {

			$spreadsheet->getActiveSheet()->setCellValue('A' . $baris, $no++);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('B' . $baris, $mstr['nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('C' . $baris, $mstr['nkk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValue('D' . $baris, $mstr['nama']);
			$spreadsheet->getActiveSheet()->setCellValue('E' . $baris, tanggal_indo($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('F' . $baris, hitung_umur($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('G' . $baris, $mstr['agama']);
			$spreadsheet->getActiveSheet()->setCellValue('H' . $baris, $mstr['jekel']);
			$spreadsheet->getActiveSheet()->setCellValue('I' . $baris, $mstr['pekerjaan']);

			$baris++;
		}



		$spreadsheet->getActiveSheet()->setTitle("Data Agama Islam");
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_agama_islam.Xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);

		$writer->save('php://output');

		exit;
	}

	public function agama_protestan()
	{
		$data = [
			'tittle' => 'Penduduk Agama Protestan',
			'isi' => 'Agama/v_protestan',

		];
		echo view('layout/v_wrapper', $data);
	}

	public function jquery_master_protestan()
	{
		$listing = $this->HomeModel->get_datatables_protestan();
		$jumlah_semua = $this->HomeModel->count_all_protestan();
		$jumlah_filter = $this->HomeModel->count_filtered_protestan();

		$data = array();
		$no = @$_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<a href="' . site_url('Datamaster/delete/' . $key->id_mstr) . '" onclick="return confirm(\'Yakin....?\')" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i></a>
            <a href="' . site_url('Datamaster/detail/' . $key->id_mstr) . '" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>';
			$row[] = $key->nik;
			$row[] = $key->nkk;
			$row[] = $key->nama;
			$row[] = tanggal_indo($key->tgl_lahir);
			$row[] = hitung_umur($key->tgl_lahir);
			$row[] = $key->agama;
			$row[] = $key->jekel;
			$row[] = $key->pekerjaan;
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsFiltered" => $jumlah_filter->jml,
			"recordsTotal" => $jumlah_semua->jml,
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function excel_protestan()
	{
		$data['db_mstr'] =  $this->HomeModel->get_agama_protestan_p();


		$spreadsheet = new Spreadsheet;

		$spreadsheet->getProperties()->setCreator("Dion Kuarta");
		$spreadsheet->getProperties()->setLastModifiedBy("Dion Kuarta");

		$spreadsheet->getProperties()->setTitle("Data Agama Protestan");
		$spreadsheet->getActiveSheetIndex(0);



		$spreadsheet->getActiveSheet()->setCellValue('A1', 'NO');
		$spreadsheet->getActiveSheet()->setCellValue('B1', 'NIK');
		$spreadsheet->getActiveSheet()->setCellValue('C1', 'NKK');
		$spreadsheet->getActiveSheet()->setCellValue('D1', 'NAMA');
		$spreadsheet->getActiveSheet()->setCellValue('E1', 'TANGGAL LAHIR');
		$spreadsheet->getActiveSheet()->setCellValue('F1', 'UMUR');
		$spreadsheet->getActiveSheet()->setCellValue('G1', 'AGAMA');
		$spreadsheet->getActiveSheet()->setCellValue('H1', 'JENIS KELAMIN');
		$spreadsheet->getActiveSheet()->setCellValue('I1', 'PEKERJAAN');

		$baris = 2;
		$no = 1;

		foreach ($data['db_mstr'] as $mstr) {

			$spreadsheet->getActiveSheet()->setCellValue('A' . $baris, $no++);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('B' . $baris, $mstr['nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('C' . $baris, $mstr['nkk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValue('D' . $baris, $mstr['nama']);
			$spreadsheet->getActiveSheet()->setCellValue('E' . $baris, tanggal_indo($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('F' . $baris, hitung_umur($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('G' . $baris, $mstr['agama']);
			$spreadsheet->getActiveSheet()->setCellValue('H' . $baris, $mstr['jekel']);
			$spreadsheet->getActiveSheet()->setCellValue('I' . $baris, $mstr['pekerjaan']);

			$baris++;
		}



		$spreadsheet->getActiveSheet()->setTitle("Data Agama Protestan");
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_agama_Protestan.Xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);

		$writer->save('php://output');

		exit;
	}

	public function agama_katolik()
	{
		$data = [
			'tittle' => 'Penduduk Agama Katolik',
			'isi' => 'Agama/v_katolik',

		];
		echo view('layout/v_wrapper', $data);
	}

	public function jquery_master_katolik()
	{
		$listing = $this->HomeModel->get_datatables_katolik();
		$jumlah_semua = $this->HomeModel->count_all_katolik();
		$jumlah_filter = $this->HomeModel->count_filtered_katolik();

		$data = array();
		$no = @$_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<a href="' . site_url('Datamaster/delete/' . $key->id_mstr) . '" onclick="return confirm(\'Yakin....?\')" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i></a>
            <a href="' . site_url('Datamaster/detail/' . $key->id_mstr) . '" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>';
			$row[] = $key->nik;
			$row[] = $key->nkk;
			$row[] = $key->nama;
			$row[] = tanggal_indo($key->tgl_lahir);
			$row[] = hitung_umur($key->tgl_lahir);
			$row[] = $key->agama;
			$row[] = $key->jekel;
			$row[] = $key->pekerjaan;
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsFiltered" => $jumlah_filter->jml,
			"recordsTotal" => $jumlah_semua->jml,
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function excel_katolik()
	{
		$data['db_mstr'] =  $this->HomeModel->get_agama_katolik_p();


		$spreadsheet = new Spreadsheet;

		$spreadsheet->getProperties()->setCreator("Dion Kuarta");
		$spreadsheet->getProperties()->setLastModifiedBy("Dion Kuarta");

		$spreadsheet->getProperties()->setTitle("Data Agama Katolik");
		$spreadsheet->getActiveSheetIndex(0);



		$spreadsheet->getActiveSheet()->setCellValue('A1', 'NO');
		$spreadsheet->getActiveSheet()->setCellValue('B1', 'NIK');
		$spreadsheet->getActiveSheet()->setCellValue('C1', 'NKK');
		$spreadsheet->getActiveSheet()->setCellValue('D1', 'NAMA');
		$spreadsheet->getActiveSheet()->setCellValue('E1', 'TANGGAL LAHIR');
		$spreadsheet->getActiveSheet()->setCellValue('F1', 'UMUR');
		$spreadsheet->getActiveSheet()->setCellValue('G1', 'AGAMA');
		$spreadsheet->getActiveSheet()->setCellValue('H1', 'JENIS KELAMIN');
		$spreadsheet->getActiveSheet()->setCellValue('I1', 'PEKERJAAN');

		$baris = 2;
		$no = 1;

		foreach ($data['db_mstr'] as $mstr) {

			$spreadsheet->getActiveSheet()->setCellValue('A' . $baris, $no++);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('B' . $baris, $mstr['nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('C' . $baris, $mstr['nkk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValue('D' . $baris, $mstr['nama']);
			$spreadsheet->getActiveSheet()->setCellValue('E' . $baris, tanggal_indo($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('F' . $baris, hitung_umur($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('G' . $baris, $mstr['agama']);
			$spreadsheet->getActiveSheet()->setCellValue('H' . $baris, $mstr['jekel']);
			$spreadsheet->getActiveSheet()->setCellValue('I' . $baris, $mstr['pekerjaan']);

			$baris++;
		}



		$spreadsheet->getActiveSheet()->setTitle("Data Agama Katolik");
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_agama_Katolik.Xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);

		$writer->save('php://output');

		exit;
	}

	public function agama_hindu()
	{
		$data = [
			'tittle' => 'Penduduk Agama Hindu',
			'isi' => 'Agama/v_hindu',

		];
		echo view('layout/v_wrapper', $data);
	}

	public function jquery_master_hindu()
	{
		$listing = $this->HomeModel->get_datatables_hindu();
		$jumlah_semua = $this->HomeModel->count_all_hindu();
		$jumlah_filter = $this->HomeModel->count_filtered_hindu();

		$data = array();
		$no = @$_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<a href="' . site_url('Datamaster/delete/' . $key->id_mstr) . '" onclick="return confirm(\'Yakin....?\')" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i></a>
            <a href="' . site_url('Datamaster/detail/' . $key->id_mstr) . '" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>';
			$row[] = $key->nik;
			$row[] = $key->nkk;
			$row[] = $key->nama;
			$row[] = tanggal_indo($key->tgl_lahir);
			$row[] = hitung_umur($key->tgl_lahir);
			$row[] = $key->agama;
			$row[] = $key->jekel;
			$row[] = $key->pekerjaan;
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsFiltered" => $jumlah_filter->jml,
			"recordsTotal" => $jumlah_semua->jml,
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function excel_hindu()
	{
		$data['db_mstr'] =  $this->HomeModel->get_agama_hindu_p();


		$spreadsheet = new Spreadsheet;

		$spreadsheet->getProperties()->setCreator("Dion Kuarta");
		$spreadsheet->getProperties()->setLastModifiedBy("Dion Kuarta");

		$spreadsheet->getProperties()->setTitle("Data Agama Hindu");
		$spreadsheet->getActiveSheetIndex(0);



		$spreadsheet->getActiveSheet()->setCellValue('A1', 'NO');
		$spreadsheet->getActiveSheet()->setCellValue('B1', 'NIK');
		$spreadsheet->getActiveSheet()->setCellValue('C1', 'NKK');
		$spreadsheet->getActiveSheet()->setCellValue('D1', 'NAMA');
		$spreadsheet->getActiveSheet()->setCellValue('E1', 'TANGGAL LAHIR');
		$spreadsheet->getActiveSheet()->setCellValue('F1', 'UMUR');
		$spreadsheet->getActiveSheet()->setCellValue('G1', 'AGAMA');
		$spreadsheet->getActiveSheet()->setCellValue('H1', 'JENIS KELAMIN');
		$spreadsheet->getActiveSheet()->setCellValue('I1', 'PEKERJAAN');

		$baris = 2;
		$no = 1;

		foreach ($data['db_mstr'] as $mstr) {

			$spreadsheet->getActiveSheet()->setCellValue('A' . $baris, $no++);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('B' . $baris, $mstr['nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('C' . $baris, $mstr['nkk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValue('D' . $baris, $mstr['nama']);
			$spreadsheet->getActiveSheet()->setCellValue('E' . $baris, tanggal_indo($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('F' . $baris, hitung_umur($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('G' . $baris, $mstr['agama']);
			$spreadsheet->getActiveSheet()->setCellValue('H' . $baris, $mstr['jekel']);
			$spreadsheet->getActiveSheet()->setCellValue('I' . $baris, $mstr['pekerjaan']);

			$baris++;
		}



		$spreadsheet->getActiveSheet()->setTitle("Data Agama Hindu");
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_agama_Hindu.Xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);

		$writer->save('php://output');

		exit;
	}

	public function agama_buddha()
	{
		$data = [
			'tittle' => 'Penduduk Agama Buddha',
			'isi' => 'Agama/v_buddha',

		];
		echo view('layout/v_wrapper', $data);
	}

	public function jquery_master_buddha()
	{
		$listing = $this->HomeModel->get_datatables_buddha();
		$jumlah_semua = $this->HomeModel->count_all_buddha();
		$jumlah_filter = $this->HomeModel->count_filtered_buddha();

		$data = array();
		$no = @$_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<a href="' . site_url('Datamaster/delete/' . $key->id_mstr) . '" onclick="return confirm(\'Yakin....?\')" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i></a>
            <a href="' . site_url('Datamaster/detail/' . $key->id_mstr) . '" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>';
			$row[] = $key->nik;
			$row[] = $key->nkk;
			$row[] = $key->nama;
			$row[] = tanggal_indo($key->tgl_lahir);
			$row[] = hitung_umur($key->tgl_lahir);
			$row[] = $key->agama;
			$row[] = $key->jekel;
			$row[] = $key->pekerjaan;
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsFiltered" => $jumlah_filter->jml,
			"recordsTotal" => $jumlah_semua->jml,
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function excel_buddha()
	{
		$data['db_mstr'] =  $this->HomeModel->get_agama_buddha_p();


		$spreadsheet = new Spreadsheet;

		$spreadsheet->getProperties()->setCreator("Dion Kuarta");
		$spreadsheet->getProperties()->setLastModifiedBy("Dion Kuarta");

		$spreadsheet->getProperties()->setTitle("Data Agama Buddha");
		$spreadsheet->getActiveSheetIndex(0);



		$spreadsheet->getActiveSheet()->setCellValue('A1', 'NO');
		$spreadsheet->getActiveSheet()->setCellValue('B1', 'NIK');
		$spreadsheet->getActiveSheet()->setCellValue('C1', 'NKK');
		$spreadsheet->getActiveSheet()->setCellValue('D1', 'NAMA');
		$spreadsheet->getActiveSheet()->setCellValue('E1', 'TANGGAL LAHIR');
		$spreadsheet->getActiveSheet()->setCellValue('F1', 'UMUR');
		$spreadsheet->getActiveSheet()->setCellValue('G1', 'AGAMA');
		$spreadsheet->getActiveSheet()->setCellValue('H1', 'JENIS KELAMIN');
		$spreadsheet->getActiveSheet()->setCellValue('I1', 'PEKERJAAN');

		$baris = 2;
		$no = 1;

		foreach ($data['db_mstr'] as $mstr) {

			$spreadsheet->getActiveSheet()->setCellValue('A' . $baris, $no++);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('B' . $baris, $mstr['nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('C' . $baris, $mstr['nkk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValue('D' . $baris, $mstr['nama']);
			$spreadsheet->getActiveSheet()->setCellValue('E' . $baris, tanggal_indo($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('F' . $baris, hitung_umur($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('G' . $baris, $mstr['agama']);
			$spreadsheet->getActiveSheet()->setCellValue('H' . $baris, $mstr['jekel']);
			$spreadsheet->getActiveSheet()->setCellValue('I' . $baris, $mstr['pekerjaan']);

			$baris++;
		}



		$spreadsheet->getActiveSheet()->setTitle("Data Agama Buddha");
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_agama_Buddha.Xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);

		$writer->save('php://output');

		exit;
	}

	public function agama_konghucu()
	{
		$data = [
			'tittle' => 'Penduduk Agama Kong Hu Cu',
			'isi' => 'Agama/v_konghucu',

		];
		echo view('layout/v_wrapper', $data);
	}

	public function jquery_master_konghucu()
	{
		$listing = $this->HomeModel->get_datatables_konghucu();
		$jumlah_semua = $this->HomeModel->count_all_konghucu();
		$jumlah_filter = $this->HomeModel->count_filtered_konghucu();

		$data = array();
		$no = @$_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<a href="' . site_url('Datamaster/delete/' . $key->id_mstr) . '" onclick="return confirm(\'Yakin....?\')" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i></a>
            <a href="' . site_url('Datamaster/detail/' . $key->id_mstr) . '" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>';
			$row[] = $key->nik;
			$row[] = $key->nkk;
			$row[] = $key->nama;
			$row[] = tanggal_indo($key->tgl_lahir);
			$row[] = hitung_umur($key->tgl_lahir);
			$row[] = $key->agama;
			$row[] = $key->jekel;
			$row[] = $key->pekerjaan;
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsFiltered" => $jumlah_filter->jml,
			"recordsTotal" => $jumlah_semua->jml,
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function excel_konghucu()
	{
		$data['db_mstr'] =  $this->HomeModel->get_agama_konghucu_p();


		$spreadsheet = new Spreadsheet;

		$spreadsheet->getProperties()->setCreator("Dion Kuarta");
		$spreadsheet->getProperties()->setLastModifiedBy("Dion Kuarta");

		$spreadsheet->getProperties()->setTitle("Data Agama Kong Hu Cu");
		$spreadsheet->getActiveSheetIndex(0);



		$spreadsheet->getActiveSheet()->setCellValue('A1', 'NO');
		$spreadsheet->getActiveSheet()->setCellValue('B1', 'NIK');
		$spreadsheet->getActiveSheet()->setCellValue('C1', 'NKK');
		$spreadsheet->getActiveSheet()->setCellValue('D1', 'NAMA');
		$spreadsheet->getActiveSheet()->setCellValue('E1', 'TANGGAL LAHIR');
		$spreadsheet->getActiveSheet()->setCellValue('F1', 'UMUR');
		$spreadsheet->getActiveSheet()->setCellValue('G1', 'AGAMA');
		$spreadsheet->getActiveSheet()->setCellValue('H1', 'JENIS KELAMIN');
		$spreadsheet->getActiveSheet()->setCellValue('I1', 'PEKERJAAN');

		$baris = 2;
		$no = 1;

		foreach ($data['db_mstr'] as $mstr) {

			$spreadsheet->getActiveSheet()->setCellValue('A' . $baris, $no++);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('B' . $baris, $mstr['nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('C' . $baris, $mstr['nkk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValue('D' . $baris, $mstr['nama']);
			$spreadsheet->getActiveSheet()->setCellValue('E' . $baris, tanggal_indo($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('F' . $baris, hitung_umur($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('G' . $baris, $mstr['agama']);
			$spreadsheet->getActiveSheet()->setCellValue('H' . $baris, $mstr['jekel']);
			$spreadsheet->getActiveSheet()->setCellValue('I' . $baris, $mstr['pekerjaan']);

			$baris++;
		}



		$spreadsheet->getActiveSheet()->setTitle("Data Agama Kong Hu Cu");
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_agama_Kong_hu_cu.Xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);

		$writer->save('php://output');

		exit;
	}

	public function stunting()
	{
		$data = [
			'tittle' => 'Stunting',
			'isi' => 'Usia/v_stunting',

		];
		echo view('layout/v_wrapper', $data);
	}

	public function jquery_master_stunting()
	{
		$listing = $this->HomeModel->get_datatables_stunting();
		$jumlah_semua = $this->HomeModel->count_all_stunting();
		$jumlah_filter = $this->HomeModel->count_filtered_stunting();

		$data = array();
		$no = @$_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<a href="' . site_url('Datamaster/delete/' . $key->id_mstr) . '" onclick="return confirm(\'Yakin....?\')" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i></a>
            <a href="' . site_url('Datamaster/detail/' . $key->id_mstr) . '" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>';
			$row[] = $key->nik;
			$row[] = $key->nkk;
			$row[] = $key->nama;
			$row[] = tanggal_indo($key->tgl_lahir);
			$row[] = hitung_umur($key->tgl_lahir);
			$row[] = $key->jorong;
			$row[] = $key->agama;
			$row[] = $key->jekel;
			$row[] = $key->pekerjaan;
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsFiltered" => $jumlah_filter->jml,
			"recordsTotal" => $jumlah_semua->jml,
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function excel_stunting()
	{
		$data['db_mstr'] =  $this->HomeModel->get_stunting();


		$spreadsheet = new Spreadsheet;

		$spreadsheet->getProperties()->setCreator("Dion Kuarta");
		$spreadsheet->getProperties()->setLastModifiedBy("Dion Kuarta");

		$spreadsheet->getProperties()->setTitle("Data Stunting");
		$spreadsheet->getActiveSheetIndex(0);



		$spreadsheet->getActiveSheet()->setCellValue('A1', 'NO');
		$spreadsheet->getActiveSheet()->setCellValue('B1', 'NIK');
		$spreadsheet->getActiveSheet()->setCellValue('C1', 'NKK');
		$spreadsheet->getActiveSheet()->setCellValue('D1', 'NAMA');
		$spreadsheet->getActiveSheet()->setCellValue('E1', 'TANGGAL LAHIR');
		$spreadsheet->getActiveSheet()->setCellValue('F1', 'UMUR');
		$spreadsheet->getActiveSheet()->setCellValue('G1', 'JORONG');
		$spreadsheet->getActiveSheet()->setCellValue('H1', 'AGAMA');
		$spreadsheet->getActiveSheet()->setCellValue('I1', 'JENIS KELAMIN');
		$spreadsheet->getActiveSheet()->setCellValue('J1', 'PEKERJAAN');

		$baris = 2;
		$no = 1;

		foreach ($data['db_mstr'] as $mstr) {

			$spreadsheet->getActiveSheet()->setCellValue('A' . $baris, $no++);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('B' . $baris, $mstr['nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('C' . $baris, $mstr['nkk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValue('D' . $baris, $mstr['nama']);
			$spreadsheet->getActiveSheet()->setCellValue('E' . $baris, tanggal_indo($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('F' . $baris, hitung_umur($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('G' . $baris, $mstr['jorong']);
			$spreadsheet->getActiveSheet()->setCellValue('H' . $baris, $mstr['agama']);
			$spreadsheet->getActiveSheet()->setCellValue('I' . $baris, $mstr['jekel']);
			$spreadsheet->getActiveSheet()->setCellValue('J' . $baris, $mstr['pekerjaan']);

			$baris++;
		}



		$spreadsheet->getActiveSheet()->setTitle("Data Stunting");
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_stunting.Xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);

		$writer->save('php://output');

		exit;
	}

	public function balita()
	{
		$data = [
			'tittle' => 'balita',
			'isi' => 'Usia/v_balita',

		];
		echo view('layout/v_wrapper', $data);
	}

	public function jquery_master_balita()
	{
		$listing = $this->HomeModel->get_datatables_balita();
		$jumlah_semua = $this->HomeModel->count_all_balita();
		$jumlah_filter = $this->HomeModel->count_filtered_balita();

		$data = array();
		$no = @$_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<a href="' . site_url('Datamaster/delete/' . $key->id_mstr) . '" onclick="return confirm(\'Yakin....?\')" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i></a>
            <a href="' . site_url('Datamaster/detail/' . $key->id_mstr) . '" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>';
			$row[] = $key->nik;
			$row[] = $key->nkk;
			$row[] = $key->nama;
			$row[] = tanggal_indo($key->tgl_lahir);
			$row[] = hitung_umur($key->tgl_lahir);
			$row[] = $key->jorong;
			$row[] = $key->agama;
			$row[] = $key->jekel;
			$row[] = $key->pekerjaan;
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsFiltered" => $jumlah_filter->jml,
			"recordsTotal" => $jumlah_semua->jml,
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function excel_balita()
	{
		$data['db_mstr'] =  $this->HomeModel->get_balita();


		$spreadsheet = new Spreadsheet;

		$spreadsheet->getProperties()->setCreator("Dion Kuarta");
		$spreadsheet->getProperties()->setLastModifiedBy("Dion Kuarta");

		$spreadsheet->getProperties()->setTitle("Data balita");
		$spreadsheet->getActiveSheetIndex(0);



		$spreadsheet->getActiveSheet()->setCellValue('A1', 'NO');
		$spreadsheet->getActiveSheet()->setCellValue('B1', 'NIK');
		$spreadsheet->getActiveSheet()->setCellValue('C1', 'NKK');
		$spreadsheet->getActiveSheet()->setCellValue('D1', 'NAMA');
		$spreadsheet->getActiveSheet()->setCellValue('E1', 'TANGGAL LAHIR');
		$spreadsheet->getActiveSheet()->setCellValue('F1', 'UMUR');
		$spreadsheet->getActiveSheet()->setCellValue('G1', 'JORONG');
		$spreadsheet->getActiveSheet()->setCellValue('H1', 'AGAMA');
		$spreadsheet->getActiveSheet()->setCellValue('I1', 'JENIS KELAMIN');
		$spreadsheet->getActiveSheet()->setCellValue('J1', 'PEKERJAAN');

		$baris = 2;
		$no = 1;

		foreach ($data['db_mstr'] as $mstr) {

			$spreadsheet->getActiveSheet()->setCellValue('A' . $baris, $no++);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('B' . $baris, $mstr['nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('C' . $baris, $mstr['nkk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValue('D' . $baris, $mstr['nama']);
			$spreadsheet->getActiveSheet()->setCellValue('E' . $baris, tanggal_indo($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('F' . $baris, hitung_umur($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('G' . $baris, $mstr['jorong']);
			$spreadsheet->getActiveSheet()->setCellValue('H' . $baris, $mstr['agama']);
			$spreadsheet->getActiveSheet()->setCellValue('I' . $baris, $mstr['jekel']);
			$spreadsheet->getActiveSheet()->setCellValue('J' . $baris, $mstr['pekerjaan']);

			$baris++;
		}



		$spreadsheet->getActiveSheet()->setTitle("Data balita");
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_balita.Xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);

		$writer->save('php://output');

		exit;
	}

	public function anak_anak()
	{
		$data = [
			'tittle' => 'Anak-Anak',
			'isi' => 'Usia/v_anak_anak',

		];
		echo view('layout/v_wrapper', $data);
	}

	public function jquery_master_anak_anak()
	{
		$listing = $this->HomeModel->get_datatables_anak_anak();
		$jumlah_semua = $this->HomeModel->count_all_anak_anak();
		$jumlah_filter = $this->HomeModel->count_filtered_anak_anak();

		$data = array();
		$no = @$_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<a href="' . site_url('Datamaster/delete/' . $key->id_mstr) . '" onclick="return confirm(\'Yakin....?\')" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i></a>
            <a href="' . site_url('Datamaster/detail/' . $key->id_mstr) . '" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>';
			$row[] = $key->nik;
			$row[] = $key->nkk;
			$row[] = $key->nama;
			$row[] = tanggal_indo($key->tgl_lahir);
			$row[] = hitung_umur($key->tgl_lahir);
			$row[] = $key->jorong;
			$row[] = $key->agama;
			$row[] = $key->jekel;
			$row[] = $key->pekerjaan;
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsFiltered" => $jumlah_filter->jml,
			"recordsTotal" => $jumlah_semua->jml,
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function excel_anak_anak()
	{
		$data['db_mstr'] =  $this->HomeModel->get_anak_anak();


		$spreadsheet = new Spreadsheet;

		$spreadsheet->getProperties()->setCreator("Dion Kuarta");
		$spreadsheet->getProperties()->setLastModifiedBy("Dion Kuarta");

		$spreadsheet->getProperties()->setTitle("Data anak_anak");
		$spreadsheet->getActiveSheetIndex(0);



		$spreadsheet->getActiveSheet()->setCellValue('A1', 'NO');
		$spreadsheet->getActiveSheet()->setCellValue('B1', 'NIK');
		$spreadsheet->getActiveSheet()->setCellValue('C1', 'NKK');
		$spreadsheet->getActiveSheet()->setCellValue('D1', 'NAMA');
		$spreadsheet->getActiveSheet()->setCellValue('E1', 'TANGGAL LAHIR');
		$spreadsheet->getActiveSheet()->setCellValue('F1', 'UMUR');
		$spreadsheet->getActiveSheet()->setCellValue('G1', 'JORONG');
		$spreadsheet->getActiveSheet()->setCellValue('H1', 'AGAMA');
		$spreadsheet->getActiveSheet()->setCellValue('I1', 'JENIS KELAMIN');
		$spreadsheet->getActiveSheet()->setCellValue('J1', 'PEKERJAAN');

		$baris = 2;
		$no = 1;

		foreach ($data['db_mstr'] as $mstr) {

			$spreadsheet->getActiveSheet()->setCellValue('A' . $baris, $no++);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('B' . $baris, $mstr['nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('C' . $baris, $mstr['nkk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValue('D' . $baris, $mstr['nama']);
			$spreadsheet->getActiveSheet()->setCellValue('E' . $baris, tanggal_indo($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('F' . $baris, hitung_umur($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('G' . $baris, $mstr['jorong']);
			$spreadsheet->getActiveSheet()->setCellValue('H' . $baris, $mstr['agama']);
			$spreadsheet->getActiveSheet()->setCellValue('I' . $baris, $mstr['jekel']);
			$spreadsheet->getActiveSheet()->setCellValue('J' . $baris, $mstr['pekerjaan']);

			$baris++;
		}



		$spreadsheet->getActiveSheet()->setTitle("Data anak_anak");
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_anak_anak.Xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);

		$writer->save('php://output');

		exit;
	}

	public function remaja()
	{
		$data = [
			'tittle' => 'remaja',
			'isi' => 'Usia/v_remaja',

		];
		echo view('layout/v_wrapper', $data);
	}

	public function jquery_master_remaja()
	{
		$listing = $this->HomeModel->get_datatables_remaja();
		$jumlah_semua = $this->HomeModel->count_all_remaja();
		$jumlah_filter = $this->HomeModel->count_filtered_remaja();

		$data = array();
		$no = @$_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<a href="' . site_url('Datamaster/delete/' . $key->id_mstr) . '" onclick="return confirm(\'Yakin....?\')" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i></a>
            <a href="' . site_url('Datamaster/detail/' . $key->id_mstr) . '" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>';
			$row[] = $key->nik;
			$row[] = $key->nkk;
			$row[] = $key->nama;
			$row[] = tanggal_indo($key->tgl_lahir);
			$row[] = hitung_umur($key->tgl_lahir);
			$row[] = $key->jorong;
			$row[] = $key->agama;
			$row[] = $key->jekel;
			$row[] = $key->pekerjaan;
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsFiltered" => $jumlah_filter->jml,
			"recordsTotal" => $jumlah_semua->jml,
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function excel_remaja()
	{
		$data['db_mstr'] =  $this->HomeModel->get_remaja();


		$spreadsheet = new Spreadsheet;

		$spreadsheet->getProperties()->setCreator("Dion Kuarta");
		$spreadsheet->getProperties()->setLastModifiedBy("Dion Kuarta");

		$spreadsheet->getProperties()->setTitle("Data remaja");
		$spreadsheet->getActiveSheetIndex(0);



		$spreadsheet->getActiveSheet()->setCellValue('A1', 'NO');
		$spreadsheet->getActiveSheet()->setCellValue('B1', 'NIK');
		$spreadsheet->getActiveSheet()->setCellValue('C1', 'NKK');
		$spreadsheet->getActiveSheet()->setCellValue('D1', 'NAMA');
		$spreadsheet->getActiveSheet()->setCellValue('E1', 'TANGGAL LAHIR');
		$spreadsheet->getActiveSheet()->setCellValue('F1', 'UMUR');
		$spreadsheet->getActiveSheet()->setCellValue('G1', 'JORONG');
		$spreadsheet->getActiveSheet()->setCellValue('H1', 'AGAMA');
		$spreadsheet->getActiveSheet()->setCellValue('I1', 'JENIS KELAMIN');
		$spreadsheet->getActiveSheet()->setCellValue('J1', 'PEKERJAAN');

		$baris = 2;
		$no = 1;

		foreach ($data['db_mstr'] as $mstr) {

			$spreadsheet->getActiveSheet()->setCellValue('A' . $baris, $no++);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('B' . $baris, $mstr['nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('C' . $baris, $mstr['nkk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValue('D' . $baris, $mstr['nama']);
			$spreadsheet->getActiveSheet()->setCellValue('E' . $baris, tanggal_indo($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('F' . $baris, hitung_umur($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('G' . $baris, $mstr['jorong']);
			$spreadsheet->getActiveSheet()->setCellValue('H' . $baris, $mstr['agama']);
			$spreadsheet->getActiveSheet()->setCellValue('I' . $baris, $mstr['jekel']);
			$spreadsheet->getActiveSheet()->setCellValue('J' . $baris, $mstr['pekerjaan']);

			$baris++;
		}



		$spreadsheet->getActiveSheet()->setTitle("Data remaja");
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_remaja.Xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);

		$writer->save('php://output');

		exit;
	}

	public function dewasa()
	{
		$data = [
			'tittle' => 'dewasa',
			'isi' => 'Usia/v_dewasa',

		];
		echo view('layout/v_wrapper', $data);
	}

	public function jquery_master_dewasa()
	{
		$listing = $this->HomeModel->get_datatables_dewasa();
		$jumlah_semua = $this->HomeModel->count_all_dewasa();
		$jumlah_filter = $this->HomeModel->count_filtered_dewasa();

		$data = array();
		$no = @$_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<a href="' . site_url('Datamaster/delete/' . $key->id_mstr) . '" onclick="return confirm(\'Yakin....?\')" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i></a>
            <a href="' . site_url('Datamaster/detail/' . $key->id_mstr) . '" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>';
			$row[] = $key->nik;
			$row[] = $key->nkk;
			$row[] = $key->nama;
			$row[] = tanggal_indo($key->tgl_lahir);
			$row[] = hitung_umur($key->tgl_lahir);
			$row[] = $key->jorong;
			$row[] = $key->agama;
			$row[] = $key->jekel;
			$row[] = $key->pekerjaan;
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsFiltered" => $jumlah_filter->jml,
			"recordsTotal" => $jumlah_semua->jml,
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function excel_dewasa()
	{
		$data['db_mstr'] =  $this->HomeModel->get_dewasa();


		$spreadsheet = new Spreadsheet;

		$spreadsheet->getProperties()->setCreator("Dion Kuarta");
		$spreadsheet->getProperties()->setLastModifiedBy("Dion Kuarta");

		$spreadsheet->getProperties()->setTitle("Data dewasa");
		$spreadsheet->getActiveSheetIndex(0);



		$spreadsheet->getActiveSheet()->setCellValue('A1', 'NO');
		$spreadsheet->getActiveSheet()->setCellValue('B1', 'NIK');
		$spreadsheet->getActiveSheet()->setCellValue('C1', 'NKK');
		$spreadsheet->getActiveSheet()->setCellValue('D1', 'NAMA');
		$spreadsheet->getActiveSheet()->setCellValue('E1', 'TANGGAL LAHIR');
		$spreadsheet->getActiveSheet()->setCellValue('F1', 'UMUR');
		$spreadsheet->getActiveSheet()->setCellValue('G1', 'JORONG');
		$spreadsheet->getActiveSheet()->setCellValue('H1', 'AGAMA');
		$spreadsheet->getActiveSheet()->setCellValue('I1', 'JENIS KELAMIN');
		$spreadsheet->getActiveSheet()->setCellValue('J1', 'PEKERJAAN');

		$baris = 2;
		$no = 1;

		foreach ($data['db_mstr'] as $mstr) {

			$spreadsheet->getActiveSheet()->setCellValue('A' . $baris, $no++);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('B' . $baris, $mstr['nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('C' . $baris, $mstr['nkk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValue('D' . $baris, $mstr['nama']);
			$spreadsheet->getActiveSheet()->setCellValue('E' . $baris, tanggal_indo($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('F' . $baris, hitung_umur($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('G' . $baris, $mstr['jorong']);
			$spreadsheet->getActiveSheet()->setCellValue('H' . $baris, $mstr['agama']);
			$spreadsheet->getActiveSheet()->setCellValue('I' . $baris, $mstr['jekel']);
			$spreadsheet->getActiveSheet()->setCellValue('J' . $baris, $mstr['pekerjaan']);

			$baris++;
		}



		$spreadsheet->getActiveSheet()->setTitle("Data dewasa");
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_dewasa.Xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);

		$writer->save('php://output');

		exit;
	}

	public function lansia()
	{
		$data = [
			'tittle' => 'lansia',
			'isi' => 'Usia/v_lansia',

		];
		echo view('layout/v_wrapper', $data);
	}

	public function jquery_master_lansia()
	{
		$listing = $this->HomeModel->get_datatables_lansia();
		$jumlah_semua = $this->HomeModel->count_all_lansia();
		$jumlah_filter = $this->HomeModel->count_filtered_lansia();

		$data = array();
		$no = @$_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<a href="' . site_url('Datamaster/delete/' . $key->id_mstr) . '" onclick="return confirm(\'Yakin....?\')" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i></a>
            <a href="' . site_url('Datamaster/detail/' . $key->id_mstr) . '" class="btn btn-info btn-xs"><i class="fas fa-eye fa-xs"></i></a>';
			$row[] = $key->nik;
			$row[] = $key->nkk;
			$row[] = $key->nama;
			$row[] = tanggal_indo($key->tgl_lahir);
			$row[] = hitung_umur($key->tgl_lahir);
			$row[] = $key->jorong;
			$row[] = $key->agama;
			$row[] = $key->jekel;
			$row[] = $key->pekerjaan;
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsFiltered" => $jumlah_filter->jml,
			"recordsTotal" => $jumlah_semua->jml,
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function excel_lansia()
	{
		$data['db_mstr'] =  $this->HomeModel->get_lansia();


		$spreadsheet = new Spreadsheet;

		$spreadsheet->getProperties()->setCreator("Dion Kuarta");
		$spreadsheet->getProperties()->setLastModifiedBy("Dion Kuarta");

		$spreadsheet->getProperties()->setTitle("Data lansia");
		$spreadsheet->getActiveSheetIndex(0);



		$spreadsheet->getActiveSheet()->setCellValue('A1', 'NO');
		$spreadsheet->getActiveSheet()->setCellValue('B1', 'NIK');
		$spreadsheet->getActiveSheet()->setCellValue('C1', 'NKK');
		$spreadsheet->getActiveSheet()->setCellValue('D1', 'NAMA');
		$spreadsheet->getActiveSheet()->setCellValue('E1', 'TANGGAL LAHIR');
		$spreadsheet->getActiveSheet()->setCellValue('F1', 'UMUR');
		$spreadsheet->getActiveSheet()->setCellValue('G1', 'JORONG');
		$spreadsheet->getActiveSheet()->setCellValue('H1', 'AGAMA');
		$spreadsheet->getActiveSheet()->setCellValue('I1', 'JENIS KELAMIN');
		$spreadsheet->getActiveSheet()->setCellValue('J1', 'PEKERJAAN');

		$baris = 2;
		$no = 1;

		foreach ($data['db_mstr'] as $mstr) {

			$spreadsheet->getActiveSheet()->setCellValue('A' . $baris, $no++);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('B' . $baris, $mstr['nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValueExplicit('C' . $baris, $mstr['nkk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$spreadsheet->getActiveSheet()->setCellValue('D' . $baris, $mstr['nama']);
			$spreadsheet->getActiveSheet()->setCellValue('E' . $baris, tanggal_indo($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('F' . $baris, hitung_umur($mstr['tgl_lahir']));
			$spreadsheet->getActiveSheet()->setCellValue('G' . $baris, $mstr['jorong']);
			$spreadsheet->getActiveSheet()->setCellValue('H' . $baris, $mstr['agama']);
			$spreadsheet->getActiveSheet()->setCellValue('I' . $baris, $mstr['jekel']);
			$spreadsheet->getActiveSheet()->setCellValue('J' . $baris, $mstr['pekerjaan']);

			$baris++;
		}



		$spreadsheet->getActiveSheet()->setTitle("Data lansia");
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_lansia.Xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);

		$writer->save('php://output');

		exit;
	}
}
