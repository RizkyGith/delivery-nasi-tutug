<?php

namespace App\Report;

use Norm\Norm;
use \Bono\Helper\URL;
use PHPExcel;
use PHPExcel_Settings;
use PHPExcel_Worksheet_PageSetup;
use Bono\App;
use TCPDF;
use App\Report\CustomTCPDF;
use \ROH\Util\Inflector;
use PHPExcel_Style_Fill;
use PHPExcel_Style_Alignment;
use \Norm\Schema\String;
use \Norm\Schema\Reference;
use \App\Schema\SysParamReference;
use \App\Schema\HumanTime;
use PHPExcel_Style_Border;


class ReportExport{

	protected $startrow = 1;
	protected $startcolumn = 'A';
	protected $templatehtml;
	protected $templateexcel;
	protected $template;
	protected $app;
	protected $signature = array();
	protected $filterhead = array();
	protected $style = false;

	public $globalconfig;


	public static function create($app){
		return new ReportExport($app);
	}


	public function __construct($app,$template = false){
		$this->app = $app;
		$this->template = $template;
		$this->globalconfig  = $this->app->config('report');

	}

	public function setFilterHead($filterhead){
			$this->filterhead = $filterhead;
			return $this;
	}


	public function setStyle($style){
		$this->style = $style;
		return $this;
	}

	public function setTemplateExcel($template,$startrow = 1,$startcolumn = 'A'){
		$this->templateexcel = $template;
		$this->startrow = $startrow;
		$this->startcolumn = $startcolumn;
		return $this;

	}

	public function setTemplateHTML($template){
		$this->templatehtml = $template;
		return $this;
	}

	public function usingTemplate($using = false){
		$this->template = $using;
		return $this;
	}

	public function setSignature($signature){
		$this->signature = $signature;

		return $this;

	}


	private function headerReport(&$schema,$config = null){
		$header = array();
		$newschema = array();

		if(!empty($config['columns'])){
			$iterator = $config['columns'];
			foreach ($iterator as $key => $obj){
				if($schema[$key]){
					$header[] = $schema[$key]['label'];
					$newschema[$key] = $schema[$key];
				}
			}
			$schema = $newschema;

		}else{
			$header = array_keys($schema);
		}


		return $header;
	}


	private function filterHeaderExcel(&$objexcel){
		$rowindex = $this->startrow;

		$filter = $this->filterhead;

		if(empty($filter)){
			$filter = array();
		}

		foreach ($filter as $key => $value) {
			$objexcel->getActiveSheet()->setCellValueByColumnAndRow(0, $rowindex, Inflector::classify($key) .': ' .$value);
			$objexcel->getActiveSheet()->mergeCells("A".$rowindex.":C".$rowindex);
			$objexcel->getActiveSheet()->getStyle('A'.$rowindex)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'ffff00'))));
			$rowindex++;
		}
		if(!empty($filter)){
			$this->startrow = $rowindex+1;
		}

	}


	private function generateExcelObject($data,$schema,$config,$reportname){
		/* Initial PHPExcel */
		$objexcel  = new PHPExcel();

		/* Get Config */
		$defaultConfig = $config['default'];

		/* Get Header */
		$schema = $schema->toArray();
		$header = $this->headerReport($schema,$config[$reportname]);

		/* Load Default Template */
		if($this->template){
			if(!empty($this->templateexcel)){
				$objReader = \PHPExcel_IOFactory::createReader('Excel2007');
				$objexcel = $objReader->load($this->templateexcel);
			}
		}

		/* Set Report Title */
		$objexcel->getProperties()
                 ->setTitle("Report")
                 ->setSubject("Report");

		/* Report Date */
		$objexcel->getActiveSheet()->setCellValueByColumnAndRow(9, 1, 'Report Date : '.date('d-m-Y'));


		/************************************* Cleansing Data *************************************/
		$newdata= array();


		foreach ($data as $key => $row) {
			$newrow = array();

			foreach ($schema as $field => $obj) {
				$d='';
				if(!empty($row[$field])){
					$d= $row[$field];
				}

				// if(($obj instanceof \Norm\Schema\Reference || $obj instanceof \App\Schema\Separator || $obj instanceof \Norm\Schema\DateTime)  && !empty($d)){
				// 	$d = $obj->cell($d);
				// }

				if($d instanceof \Norm\Type\DateTime){
					// $d = $d->__toString();
					$d = date('Y-m-d H:i:s', strtotime($d));
				}
				$newrow[] = $d;
        	}
        	$newdata[] = $newrow;
        }
    	unset($newrow);
		/************************************* Cleansing Data *************************************/

		$startcolumn = $this->startcolumn;

		/********************* CREATE HEADER *********************/
        $objexcel->getDefaultStyle()->getFont()
                    ->setName('Arial')
                    ->setSize(9);

		$startrow = $objexcel->getActiveSheet()->getHighestRow()+2;
		$objexcel->getActiveSheet()->fromArray($header,'',$startcolumn.$startrow);
		if($this->style){
			$objexcel->getActiveSheet()->getStyle($this->numberToColumnExcel(1,$startcolumn).$startrow.':'.$this->numberToColumnExcel(count($header),$startcolumn).$startrow)->applyFromArray(array('borders' => $defaultConfig['excel']['borders']));
			$objexcel->getActiveSheet()->getStyle($this->numberToColumnExcel(1,$startcolumn).$startrow.':'.$this->numberToColumnExcel(count($header),$startcolumn).$startrow)->applyFromArray(array('fill' => $defaultConfig['excel']['fill']));
			$objexcel->getActiveSheet()->getStyle($this->numberToColumnExcel(1,$startcolumn).$startrow.':'.$this->numberToColumnExcel(count($header),$startcolumn).$startrow)->applyFromArray(array('font' => $defaultConfig['excel']['font']));
			$objexcel->getActiveSheet()->getStyle($this->numberToColumnExcel(1,$startcolumn).$startrow.':'.$this->numberToColumnExcel(count($header),$startcolumn).$startrow)->applyFromArray(
				array(
					'alignment' => array(
						'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
						'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
					)
				)
			);
		}
		/********************* CREATE HEADER *********************/

		foreach ($newdata as $k => $new) {
			$i = ord($startcolumn) - 65;

			/********************* CREATE DATA ROW *********************/
			$no = 0;
			$col = 0;
			$row = $objexcel->getActiveSheet()->getHighestRow()+1;
			foreach ($new as $num => $assets) {

	            $objexcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $assets);

	            if($this->style){
	            	$objexcel->getActiveSheet()->getStyleByColumnAndRow($col, $row)->applyFromArray(array('borders' => $defaultConfig['excel']['borders']));
	            	$objexcel->getActiveSheet()->getStyleByColumnAndRow($col, $row)->applyFromArray(
						array(
							'alignment' => array(
								'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
							)
						)
					);
	            }
	            $col++;

			}
			/********************* CREATE DATA ROW *********************/
		}
		return $objexcel;
	}

	public function excelExportLaporan ($entries)
	{


		$objexcel = new PHPExcel();

				$theadStyle = array(
      		'font' => array(
     			'bold' => true,
     			'name' => 'Times New Roman',
     			'size' => 12
     		),
      		'fill' => array(
      			'type' => PHPExcel_Style_Fill::FILL_SOLID,
          		'color' => array('rgb' => 'CCCCCC')
      		),
      		'alignment' => array(
      			'horizontal' => 'left'
      		)
     	);

     	$IsiStyle = array(
      		'font' => array(
     			'name' => 'Times New Roman',
     			'size' => 11
     		),
     	);

		$theadChildStyle = array(
      		// 'font' => array(
        //   	'bold' => true
      		// ),
      		'fill' => array(
      			'type' => PHPExcel_Style_Fill::FILL_SOLID,
          		'color' => array('rgb' => 'CCCCCC')
      		),
      		'alignment' => array(
      			'horizontal' => 'left'
      		)
     	);

     	$alignmentRightStyle = array(
     		'alignment' => array(
      			'horizontal' => 'right'
      		)
     	);

     	$headerLaporan = array(
     		'alignment' => array(
     			'horizontal' => 'center'
     		),

     		'font' => array(
     			'bold' => true,
     			'name' => 'Times New Roman',
     			'size' => 14
     		)
     	);

     	$colorFooter = array(
     		'fill' => array(
      			'type' => PHPExcel_Style_Fill::FILL_SOLID,
          		'color' => array('rgb' => 'E8E8E8')
      		),
      		'alignment' => array(
     			'horizontal' => 'right'
     		),
     	);

     	$totalTransaksiLaporan = array(
     		'font' => array(
     			'bold' => true,
     			'name' => 'Times New Roman',
     			'size' => 12
     		),
     		'fill' => array(
          		'color' => array('rgb' => 'E8E8E8')
      		)
     	);

     	$borders = array(
     		'borders' => array(
			    'allborders' => array(
			      'style' => PHPExcel_Style_Border::BORDER_THIN
			    ),
			),
     	);
     
     	
        //* laporan transaksi pada bulan dan tahun
		$array_bulan = array('1' => 'JANUARI', '2' => 'FEBRUARI', '3' => 'MARET', '4' => 'APRIL', '5' => 'MEI', '6' => 'JUNI', '7' => 'JULI', '8' => 'AGUSTUS', '9' => 'SEPTEMBER', '10' => 'OKTOBER', '11' => 'NOVEMBER',  '12' => 'DESEMBER');
        $bulan = $array_bulan[$_GET['month']];
        $bulan = $bulan; 
        $tahun = $_GET['year'];

		$objexcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($headerLaporan);
     	$objexcel->getActiveSheet()->mergeCells('A1:F1');
		$objexcel->getActiveSheet()->getStyle('A2:F2')->applyFromArray($borders);
		$objexcel->getActiveSheet()->getStyle('A2:F2')->applyFromArray($theadStyle);
		$objexcel->getActiveSheet()->SetCellValue('A1', 'LAPORAN TRANSAKSI PADA BULAN'.' '.$bulan. ' & TAHUN'.' '. $tahun);
		$objexcel->getActiveSheet()->SetCellValue('A2', 'Nama Pemesan');
		$objexcel->getActiveSheet()->SetCellValue('B2', 'Tanggal Pembelian');
		$objexcel->getActiveSheet()->SetCellValue('C2', 'Jam');
		$objexcel->getActiveSheet()->SetCellValue('D2', 'Telepon');
		$objexcel->getActiveSheet()->SetCellValue('E2', 'Status');
		$objexcel->getActiveSheet()->SetCellValue('F2', 'Total Pembelian (Rp.)');	

		foreach (range('A','F') as $i) {
			$objexcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
		}

  		//* set data to excel
  		$c = 3;
  		$limit = $c + count($entries);

  		$totalTransaksi = 0;


  		for ($i=$c; $i < $limit ; $i++) {
  			
		  	$objexcel->getActiveSheet()->getStyle('A'.$i.':F'.$i)->applyFromArray($borders);
		  	$objexcel->getActiveSheet()->getStyle('A'.$i.':F'.$i)->applyFromArray($IsiStyle);
   			$objexcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($alignmentRightStyle);

   			$objexcel->getActiveSheet()->SetCellValue('A'.$i, $entries[$i-$c]['nama_pemesan']);
   			$objexcel->getActiveSheet()->SetCellValue('B'.$i, $entries[$i-$c]['tgl_pesan']);
   			$objexcel->getActiveSheet()->SetCellValue('C'.$i, $entries[$i-$c]['jam']);
   			$objexcel->getActiveSheet()->SetCellValue('D'.$i, $entries[$i-$c]['telepon']);
   			$objexcel->getActiveSheet()->SetCellValue('E'.$i, $entries[$i-$c]['status']);
   			$objexcel->getActiveSheet()->SetCellValue('F'.$i,  number_format($entries[$i-$c]['jumlah']));

   			$totalTransaksi += $entries[$i-$c]['jumlah'];

		}
   			$objexcel->getActiveSheet()->getStyle('A'. $limit.':F'.$limit)->applyFromArray($colorFooter);
   			$objexcel->getActiveSheet()->getStyle('F')->applyFromArray($alignmentRightStyle);
   			$objexcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($totalTransaksiLaporan);
			$totalTransaksi = 'Total Laporan Transaksi Hari Ini = '.number_format($totalTransaksi);

			// $objexcel->getActiveSheet()->mergeCells('A'. $limit.':E'.$limit);
   			// $objexcel->getActiveSheet()->SetCellValue('G'.$i, $aa);
   			$objexcel->getActiveSheet()->SetCellValue('F'.$i, $totalTransaksi);


  		$objWriter = \PHPExcel_IOFactory::createWriter($objexcel, 'Excel2007');


		$objWriter->save('./data/makanan/Laporan-Transaksi.xlsx');
        header('Location:'.URL::base('/data/makanan/Laporan-Transaksi.xlsx'));
        exit();
	}

	public function excelExportTransaksi ($entries)
	{
		$objexcel = new PHPExcel();

		$theadStyle = array(
      		'font' => array(
     			'bold' => true,
     			'name' => 'Times New Roman',
     			'size' => 12
     		),
      		'fill' => array(
      			'type' => PHPExcel_Style_Fill::FILL_SOLID,
          		'color' => array('rgb' => 'CCCCCC')
      		),
      		'alignment' => array(
      			'horizontal' => 'left'
      		)
     	);

     	$IsiStyle = array(
      		'font' => array(
     			'name' => 'Times New Roman',
     			'size' => 11
     		),
     	);

		$theadChildStyle = array(
      		// 'font' => array(
        //   	'bold' => true
      		// ),
      		'fill' => array(
      			'type' => PHPExcel_Style_Fill::FILL_SOLID,
          		'color' => array('rgb' => 'CCCCCC')
      		),
      		'alignment' => array(
      			'horizontal' => 'left'
      		)
     	);

     	$alignmentRightStyle = array(
     		'alignment' => array(
      			'horizontal' => 'right'
      		)
     	);

     	$headerLaporan = array(
     		'alignment' => array(
     			'horizontal' => 'center'
     		),

     		'font' => array(
     			'bold' => true,
     			'name' => 'Times New Roman',
     			'size' => 14
     		)
     	);

     	$colorFooter = array(
     		'fill' => array(
      			'type' => PHPExcel_Style_Fill::FILL_SOLID,
          		'color' => array('rgb' => 'E8E8E8')
      		),
      		'alignment' => array(
     			'horizontal' => 'right'
     		),
     	);

     	$totalTransaksiLaporan = array(
     		'font' => array(
     			'bold' => true,
     			'name' => 'Times New Roman',
     			'size' => 12
     		),
     		'fill' => array(
          		'color' => array('rgb' => 'E8E8E8')
      		)
     	);

     	$borders = array(
     		'borders' => array(
			    'allborders' => array(
			      'style' => PHPExcel_Style_Border::BORDER_THIN
			    ),
			),
     	);

     	$array_hari = array(1=>'SENIN','SELASA','RABU','KAMIS','JUMAT', 'SABTU','MINGGU');
        $hari = $array_hari[date('N')];
        $hari = $hari; 
        $tgl  = date('d-m-Y');
     	

		$objexcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($headerLaporan);
     	$objexcel->getActiveSheet()->mergeCells('A1:F1');
		$objexcel->getActiveSheet()->getStyle('A2:F2')->applyFromArray($borders);
		$objexcel->getActiveSheet()->getStyle('A2:F2')->applyFromArray($theadStyle);
		$objexcel->getActiveSheet()->SetCellValue('A1', 'LAPORAN TRANSAKSI HARI INI'.' '. $hari .', '. $tgl);
		$objexcel->getActiveSheet()->SetCellValue('A2', 'Nama Pemesan');
		$objexcel->getActiveSheet()->SetCellValue('B2', 'Tanggal Pembelian');
		$objexcel->getActiveSheet()->SetCellValue('C2', 'Jam');
		$objexcel->getActiveSheet()->SetCellValue('D2', 'Telepon');
		$objexcel->getActiveSheet()->SetCellValue('E2', 'Status');
		$objexcel->getActiveSheet()->SetCellValue('F2', 'Total Pembelian (Rp.)');	

		foreach (range('A','F') as $i) {
			$objexcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
		}

  		//* set data to excel
  		$c = 3;
  		$limit = $c + count($entries);

  		$totalTransaksi = 0;


  		for ($i=$c; $i < $limit ; $i++) {
  			
		  	$objexcel->getActiveSheet()->getStyle('A'.$i.':F'.$i)->applyFromArray($borders);
		  	$objexcel->getActiveSheet()->getStyle('A'.$i.':F'.$i)->applyFromArray($IsiStyle);
   			$objexcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($alignmentRightStyle);

   			$objexcel->getActiveSheet()->SetCellValue('A'.$i, $entries[$i-$c]['nama_pemesan']);
   			$objexcel->getActiveSheet()->SetCellValue('B'.$i, $entries[$i-$c]['tgl_pesan']);
   			$objexcel->getActiveSheet()->SetCellValue('C'.$i, $entries[$i-$c]['jam']);
   			$objexcel->getActiveSheet()->SetCellValue('D'.$i, $entries[$i-$c]['telepon']);
   			$objexcel->getActiveSheet()->SetCellValue('E'.$i, $entries[$i-$c]['status']);
   			$objexcel->getActiveSheet()->SetCellValue('F'.$i,  number_format($entries[$i-$c]['jumlah']));

   			$totalTransaksi += $entries[$i-$c]['jumlah'];

		}
   			$objexcel->getActiveSheet()->getStyle('A'. $limit.':F'.$limit)->applyFromArray($colorFooter);
   			$objexcel->getActiveSheet()->getStyle('F')->applyFromArray($alignmentRightStyle);
   			$objexcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($totalTransaksiLaporan);
			$totalTransaksi = 'Total Laporan Transaksi Hari Ini = '.number_format($totalTransaksi);

			// $objexcel->getActiveSheet()->mergeCells('A'. $limit.':E'.$limit);
   			// $objexcel->getActiveSheet()->SetCellValue('G'.$i, $aa);
   			$objexcel->getActiveSheet()->SetCellValue('F'.$i, $totalTransaksi);


  		$objWriter = \PHPExcel_IOFactory::createWriter($objexcel, 'Excel2007');

		$objWriter->save('./data/makanan/Laporan-Transaksi.xlsx');
        header('Location:'.URL::base('/data/makanan/Laporan-Transaksi.xlsx'));
        exit();
	}

	private function numberToColumnExcel($column = 0 ,$start = 'A'){
		 $endofcol = '';
         $asciichar = ord($start) - 65;
         $length = $column + $asciichar;

         if($length > 26){
         	$first = ($column / 26);
         	$second = $column % 26;
         	$first = $asciichar + $first - 1;
         	$second = $asciichar + $second - 1;
         	$endofcol = chr($first + 65) . chr($second + 65);
         }else{
         	$endofcol = chr($column + $asciichar + 65 - 1);

         }

         return $endofcol;
	}


}


