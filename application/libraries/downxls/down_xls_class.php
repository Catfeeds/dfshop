<?php
require_once('PHPExcel.php');
class  down_xls
{
	var $objPHPExcel=NULL;
	public function down_xls()
	{
		
	}
	
	//获取列位置
	private function get_index($index)
	{
		$str='ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$a=str_split($str,1);

		if($index>25)
			return $a[floor(($index/26))-1].$a[($index)%26];
		else
			return $a[$index];
	}
	
	/*下载数据写入
	  @param  $data        array   设置的数据
	  @param  $k           int     所在行
	  @param  $index_sheet int     第几个表格   
	  @param  $index_name  string  表格名称    第1次设置有效
	*/
	public function set_data($data=array(),$k=1,$index_sheet=1,$index_name='index')
	{	
	    $index_sheet=$index_sheet<=0?0:$index_sheet-1;
		if(!is_object($this->objPHPExcel))
		{
			// Create new PHPExcel object
			$this->objPHPExcel = new PHPExcel();  
		}
		
		if(!isset($this->index_sheet[$index_sheet]))
		{
			$this->index_sheet[$index_sheet]=1;
			//第一个表格的名称
			if($index_sheet==0)
				$this->objPHPExcel->getActiveSheet()->setTitle($index_name);
			else //第2个以后表格的名称
				$this->objPHPExcel->createSheet()->setTitle($index_name);
		}
		
		
		foreach($data as $kk=>$a)
		{
			$this->objPHPExcel->setActiveSheetIndex($index_sheet)
			->setCellValueExplicit($this->get_index($kk).''.$k,iconv('utf-8','utf-8//IGNORE',$a),PHPExcel_Cell_DataType::TYPE_STRING);
		}	
	}
	
	//下载文件
	/*
		@param $name 下载名称
		return file; 下载的文件
	*/
	public function get_down_xls($name='')
	{
		// Rename worksheet
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		//$this->objPHPExcel->setActiveSheetIndex(0);
		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$name."_".date('Y-m-d').'_'.rand(100,990).'.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		$objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel5');
		//清除前面可能打印出的无用字符
		ob_clean();
		$objWriter->save('php://output');
		exit;		
	}
	
	/*
		@param $file   获取数据的文件地址
		@param $index  1=第1个表格  2=第2个表格 依次类推
		return array() 
	*/
	public function get_data($file,$index=1)
	{
		$index=$index>0?$index-1:0;
		$reader = PHPExcel_IOFactory::createReader('Excel5'); //设置以Excel5格式(Excel97-2003工作簿)
		$PHPExcel = $reader->load($file); // 载入excel文件
		$sheet = $PHPExcel->getSheet($index); // 读取第一個工作表
		$highestRow = $sheet->getHighestRow(); // 取得总行数
		$highestColumm = $sheet->getHighestColumn(); // 取得总列数
		$dataset=array();
		/** 循环读取每个单元格的数据 */
		for ($row = 1; $row <= $highestRow; $row++){//行数是以第1行开始
			$i=1;
			for ($column = 'A'; $column <= $highestColumm; $column++) {//列数是以A列开始
				$da= (string)($sheet->getCell($column.$row)->getValue());
				$dataset[$row][$i]=is_numeric($da)?$da:mysql_real_escape_string($da);
				$i++;
			}
		}
		return $dataset;
	}
}

