<?php

namespace App\Library;

use Bono\App;
use Bono\Helper\URL;
use Norm\Norm;

class THT
{
	public function tunjanganIsteri($status, $salary)
	{
		$modelCalculation = Norm::factory('Calculation');
		$dataCalculation = $modelCalculation->findOne(array('identifier' => 'tunjangan_isteri'));

		$status = strtolower($status);
		if ($status == 'k') {
			$tunjanganIsteri = $dataCalculation['value']*$salary;
			$tunjanganIsteri = $tunjanganIsteri;
		} else {
			$tunjanganIsteri = "0";
		}
		return $tunjanganIsteri;
	}

	public function tunjanganAnak($status, $children, $salary)
	{
		$modelCalculation = Norm::factory('Calculation');
		$dataCalculation = $modelCalculation->findOne(array('identifier' => 'tunjangan_anak'));

		$status = strtolower($status);
		if ($status == 'k' || $status == 'd' || $status == 'j') {
			if ($children > 0) {
				$tunjanganAnak = ($children*$dataCalculation['value'])*$salary;
				$tunjanganAnak = $tunjanganAnak;
			} else {
				$tunjanganAnak = "0";
			}
		} else {
			$tunjanganAnak = "0";
		}
		return $tunjanganAnak;
	}

	public function tunjanganPerusahaan($salary)
	{
		$modelCalculation = Norm::factory('Calculation');
		$dataCalculation = $modelCalculation->findOne(array('identifier' => 'tunjangan_perusahaan'));

		$tunjanganPerusahaan = $dataCalculation['value']*$salary;
		$tunjanganPerusahaan = $tunjanganPerusahaan;
		return $tunjanganPerusahaan;
	}

	public function tunjanganPangan($status, $children)
	{
		$modelCalculation = Norm::factory('Calculation');
		$dataCalculation = $modelCalculation->findOne(array('identifier' => 'tunjangan_pangan'));

		$status = strtolower($status);
		if ($status == 'k') {
			$tunjanganPangan = ($children+2)*$dataCalculation['value'];
			$tunjanganPangan = round($tunjanganPangan);
		} elseif ($status == 'd' || $status == 'j') {
			$tunjanganPangan = ($children+1)*$dataCalculation['value'];
			$tunjanganPangan = round($tunjanganPangan);
		} elseif ($status == 'tk') {
			$tunjanganPangan = $dataCalculation['value'];
		}
		return $tunjanganPangan;
	}

	public function dateDiffTahun($date)
	{
		$date1 = date("Y-m-d", strtotime($date));
		$date2 = date("Y-m-d");

		$dateDiff1 = date_create($date1);
		$dateDiff2 = date_create($date2);
		$diff = date_diff($dateDiff1, $dateDiff2);
		$diff = $diff->format("%R%a");

		$tahun = $diff / 365;
		$tahun = (string)floor($tahun);

		return $tahun;
	}

	public function dateDiffTahunNew($date1, $date2)
	{
		$date1 = date("Y-m-d", strtotime($date1));
		$date2 = date("Y-m-d", strtotime($date2));

		$dateDiff1 = date_create($date1);
		$dateDiff2 = date_create($date2);
		$diff = date_diff($dateDiff1, $dateDiff2);
		$diff = $diff->format("%R%a");

		$tahun = $diff / 365;
		$tahun = (string)floor($tahun);

		return $tahun;
	}

	public function dateDiffBulan($date)
	{
		$date1 = date("Y-m-d", strtotime($date));
		$date2 = date("Y-m-d");

		$dateDiff1 = date_create($date1);
		$dateDiff2 = date_create($date2);
		$diff = date_diff($dateDiff1, $dateDiff2);
		$diff = $diff->format("%R%a");

		$sisa = $diff % 365;
		$bulan = $sisa / 30;
		$bulan = (string)floor($bulan);

		return $bulan;
	}

	public function dateDiffBulanNew($date1, $date2)
	{
		$date1 = date("Y-m-d", strtotime($date1));
		$date2 = date("Y-m-d", strtotime($date2));

		$dateDiff1 = date_create($date1);
		$dateDiff2 = date_create($date2);
		$diff = date_diff($dateDiff1, $dateDiff2);
		$diff = $diff->format("%R%a");

		$sisa = $diff % 365;
		$bulan = $sisa / 30;
		$bulan = (string)floor($bulan);

		return $bulan;
	}

	public function kmkBulan($nextTahunKmk, $tahunKmk, $month)
	{
		$kmkBln = ($nextTahunKmk - $tahunKmk) / 12 * $month;
		$kmkBln = number_format($kmkBln, 4);

		return $kmkBln;
	}

	public function jumlahKmk($year, $month)
	{
		$jmlKmk = $year + $month;

		return $jmlKmk;
	}

	public function jumlahPHDT($salary, $isteri, $anak, $perusahaan, $pangan)
	{
		$jumlahPHDT = $salary + $isteri + $anak + $perusahaan + $pangan;

		return $jumlahPHDT;
	}

	public function estimasiManfaatTHT($phdt, $kmk)
	{
		$estimasi = $phdt * $kmk;

		return $estimasi;
	}

	public function tarif($perusahaan, $estimasi)
	{
		if ($perusahaan > 0) {
			$tarif = substr($estimasi, 0, -3).'000';
		} else {
			$tarif = '-';
		}

		return $tarif;
	}

	public function pphTHT($tarif)
	{
		$modelCalculation = Norm::factory('Calculation');
		$dataCalculation = $modelCalculation->findOne(array('identifier' => 'pph_pasal_21_atas_tht'));

		if ($tarif > 50000000) {
			$pphTHT = $dataCalculation['value']*($tarif - 50000000);
		} else {
			$pphTHT = '-';
		}

		return $pphTHT;
	}

	/*********** FORMULA EXCEL *************/
	public function tunjanganIsteriExcel($status, $row, $salary, $potongan = "10/100")
	{
		$tunjanganIsteriExcel = '=IF(TRIM('.$status.$row.')="TK",0,IF(TRIM('.$status.$row.')="D",0,IF(TRIM('.$status.$row.')="J",0,IF(TRIM('.$status.$row.')="K",'.$potongan.'*'.$salary.$row.',0))))';

		return $tunjanganIsteriExcel;
	}

	public function tunjanganAnakExcel($status, $row, $child, $salary, $potongan = "2/100")
	{
		$tunjanganAnakExcel = '=IF(TRIM('.$status.$row.')="TK",0,IF(OR(OR(TRIM('.$status.$row.')="K",TRIM('.$status.$row.')="J"),TRIM('.$status.$row.')="D"),('.$child.$row.'*'.$potongan.')*'.$salary.$row.',0))';

		return $tunjanganAnakExcel;
	}

	public function tunjanganPerusahaanExcel($salary, $row, $potongan = "0.3")
	{
		$tunjanganPerusahaanExcel = '='.$potongan.'*'.$salary.$row;

		return $tunjanganPerusahaanExcel;
	}

	public function tunjanganPanganExcel($status, $row, $child)
	{
		$modelCalculation = Norm::factory('Calculation');
		$dataCalculation = $modelCalculation->findOne(array('identifier' => 'tunjangan_pangan'));

		$tunjanganPanganExcel = '=IF(TRIM('.$status.$row.')=0,0,IF(TRIM('.$status.$row.')="D",('.$child.$row.'+1)*'.$dataCalculation['value'].',IF(TRIM('.$status.$row.')="J",('.$child.$row.'+1)*'.$dataCalculation['value'].',IF(TRIM('.$status.$row.')="TK",'.$dataCalculation['value'].',IF(TRIM('.$status.$row.')="K",('.$child.$row.'+2)*'.$dataCalculation['value'].',0)))))';

		return $tunjanganPanganExcel;
	}

	public function jumlahPHDTExcel($salary, $row, $pangan)
	{
		$jumlahPHDTExcel = '=SUM('.$salary.$row.':'.$pangan.$row.')';

		return $jumlahPHDTExcel;
	}

	public function estiManfaatTHTExcel($phdt, $row, $jmlKmk)
	{
		$estiManfaatTHTExcel = '='.$phdt.$row.'*'.$jmlKmk.$row;

		return $estiManfaatTHTExcel;
	}

	public function tarifExcel($perusahaan, $row, $estimasi, $other)
	{
		$tarifExcel = '=IF('.$perusahaan.$row.'=0," ",(TRUNC(('.$estimasi.$row.'+'.$other.$row.')/1000)*1000))';

		return $tarifExcel;
	}

	public function pphTHTExcel($tarif, $row, $potongan = "0.05")
	{
		$pphTHTExcel = '=IF('.$tarif.$row.'<=50000000,0,'.$potongan.'*('.$tarif.$row.'-50000000))';

		return $pphTHTExcel;
	}

	public function iuranTHTExcel($phdt, $row, $dues)
	{
		$iuranTHTExcel = '='.$phdt.$row.'*'.$dues;

		return $iuranTHTExcel;
	}

	public function jmlKmkExcel($year, $row, $month)
	{
		$jmlKmkExcel = '='.$year.$row.'+'.$month.$row;

		return $jmlKmkExcel;
	}
	/*********** FORMULA EXCEL *************/
}