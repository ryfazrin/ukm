<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JadwalModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LaporanController extends BaseController
{
    public function index()
    {
		$jadwal = new JadwalModel();
		try{
            // $data['jadwals'] = $jadwal->select('*')->get()->getResultArray();
			$data['laporans'] = $jadwal->where('status','Terlaksana')->get()->getResult();
        }
        catch(\Exception $e){
            $data['laporans']=null;
        }
        return view('laporan/index',$data);
    }

    public function createXls(){
        $jadwal = new JadwalModel();

		$data = $jadwal->where('status','Terlaksana')->get()->getResult();

		if($data){
			$file_name = date('Y-m-d').'-laporan UKM.xlsx';

			$spreadsheet = new Spreadsheet();

			$sheet = $spreadsheet->getActiveSheet();

			$sheet->mergeCells('A1:C1');
			$sheet->setCellValue('A1', 'Laporan UKM Futsal');

			$sheet->setCellValue('A2', 'Tanggal');

			$sheet->setCellValue('B2', 'Pengumuman');

			$sheet->setCellValue('C2', 'Keterangan');

			$count = 3;

			foreach($data as $row)
			{
				$sheet->setCellValue('A' . $count, $row->tanggal_jadwal);

				$sheet->setCellValue('B' . $count, $row->pengumuman);

				$sheet->setCellValue('C' . $count, $row->keterangan);

				$count++;
			}

			$writer = new Xlsx($spreadsheet);

			$writer->save($file_name);
			header("Content-Type: application/vnd.ms-excel");

			header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');

			header('Expires: 0');

			header('Cache-Control: must-revalidate');

			header('Pragma: public');

			header('Content-Length:' . filesize($file_name));

			flush();

			readfile($file_name);

			exit;
		}

		return redirect()->to('/laporan')->with('error', 'Jadwal belum terlaksana');
    }
}
