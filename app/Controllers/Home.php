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

		$data = [
			'tittle' => 'Halaman Utama',
			'isi' => 'v_home',
			'jml_penduduk' => $this->HomeModel->get_all(),
			'jml_lk' => $this->HomeModel->get_lk(),
			'jml_pr' => $this->HomeModel->get_pr(),
			'jml_kk' => $this->HomeModel->get_kk(),

			'jml_sarilamak_kk' => $this->HomeModel->get_sarilamak_kk(),
			'jml_purwajaya_kk' => $this->HomeModel->get_purwajaya_kk(),
			'jml_ketinggian_kk' => $this->HomeModel->get_ketinggian_kk(),
			'jml_air_putih_kk' => $this->HomeModel->get_air_putih_kk(),
			'jml_buluh_kasok_kk' => $this->HomeModel->get_buluh_kasok_kk(),

			'jml_purwajaya' => $this->HomeModel->get_purwajaya(),
			'jml_sarilamak' => $this->HomeModel->get_sarilamak(),
			'jml_ketinggian' => $this->HomeModel->get_ketinggian(),
			'jml_air_putih' => $this->HomeModel->get_air_putih(),
			'jml_buluh_kasok' => $this->HomeModel->get_buluh_kasok(),

		];
		echo view('layout/v_wrapper', $data);
	}


	public function jml_lk()
	{
		$data = [
			'tittle' => 'Penduduk Laki Laki',
			'db_mstr' => $this->HomeModel->get_laki(),
			'isi' => 'Datapenduduk/v_laki',

		];
		echo view('layout/v_wrapper', $data);
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
			'db_mstr' => $this->HomeModel->get_perempuan(),
			'isi' => 'Datapenduduk/v_perempuan',

		];
		echo view('layout/v_wrapper', $data);
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
			'db_kk' => $this->HomeModel->get_kk_sarilamak(),
			'isi' => 'Datapenduduk/v_ kk_sarilamak',

		];
		echo view('layout/v_wrapper', $data);
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
			'db_kk' => $this->HomeModel->get_kk_purwajaya(),
			'isi' => 'Datapenduduk/v_kk_purwajaya',

		];
		echo view('layout/v_wrapper', $data);
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
			'db_kk' => $this->HomeModel->get_kk_ketinggian(),
			'isi' => 'Datapenduduk/v_kk_ketinggian',

		];
		echo view('layout/v_wrapper', $data);
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
			'db_kk' => $this->HomeModel->get_kk_air_putih(),
			'isi' => 'Datapenduduk/v_kk_air_putih',

		];
		echo view('layout/v_wrapper', $data);
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
			'db_kk' => $this->HomeModel->get_kk_buluh_kasok(),
			'isi' => 'Datapenduduk/v_kk_buluh_kasok',

		];
		echo view('layout/v_wrapper', $data);
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
			'db_mstr' => $this->HomeModel->get_sarilamak_p(),
			'isi' => 'Datapenduduk/v_sarilamak',

		];
		echo view('layout/v_wrapper', $data);
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
			'db_mstr' => $this->HomeModel->get_purwajaya_p(),
			'isi' => 'Datapenduduk/v_purwajaya',

		];
		echo view('layout/v_wrapper', $data);
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
			'db_mstr' => $this->HomeModel->get_ketinggian_p(),
			'isi' => 'Datapenduduk/v_ketinggian',

		];
		echo view('layout/v_wrapper', $data);
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
			'db_mstr' => $this->HomeModel->get_air_putih_p(),
			'isi' => 'Datapenduduk/v_air_putih',

		];
		echo view('layout/v_wrapper', $data);
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
			'db_mstr' => $this->HomeModel->get_buluh_kasok_p(),
			'isi' => 'Datapenduduk/v_buluh_kasok',

		];
		echo view('layout/v_wrapper', $data);
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
}
