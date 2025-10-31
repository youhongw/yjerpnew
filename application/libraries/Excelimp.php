<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2010 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2010 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.7.4, 2010-08-26
 */
/** Error reporting */
error_reporting(E_ALL);
date_default_timezone_set("Asia/Taipei");


/** PHPExcel */
require_once 'Classes/PHPExcel.php';
/**
 * 输出到页面上的EXCEL
 * 
 * 
 */ 
class Excelimp
{   
   private $cellArray = array(
                        1=>'A', 2=>'B', 3=>'C', 4=>'D', 5=>'E',
                        6=>'F', 7=>'G', 8=>'H', 9=>'I',10=>'J',
                        11=>'K',12=>'L',13=>'M',14=>'N',15=>'O',
                        16=>'P',17=>'Q',18=>'R',19=>'S',20=>'T',
                        21=>'U',22=>'V',23=>'W',24=>'X',25=>'Y',
                        26=>'Z',
                        27=>'AA', 28=>'AB', 29=>'AC', 30=>'AD', 31=>'AE',
                        32=>'AF', 33=>'AG', 34=>'AH', 35=>'AI',36=>'AJ',
                        37=>'AK',38=>'AL',39=>'AM',40=>'AN',41=>'AO',
                        42=>'AP',43=>'AQ',44=>'AR',45=>'AS',46=>'AT',
                        47=>'AU',48=>'AV',49=>'AW',50=>'AX',51=>'AY',
                        52=>'AZ',
						53=>'BA', 54=>'BB', 55=>'BC', 56=>'BD', 57=>'BE',
                        58=>'BF', 59=>'BG', 60=>'BH', 61=>'BI', 62=>'BJ', 63=>'BK', 64=>'BL',
						65=>'BM', 66=>'BN', 67=>'BO', 68=>'BP', 69=>'BQ', 70=>'BR', 71=>'BS',
						72=>'BT', 73=>'BU', 74=>'BV', 75=>'BW', 76=>'BX', 77=>'BY', 78=>'BZ',
						79=>'CA', 80=>'CB', 81=>'CC', 82=>'CD', 83=>'CE', 84=>'CF', 85=>'CG',
						86=>'CH', 87=>'CI', 88=>'CJ', 89=>'CK', 90=>'CL', 91=>'CM', 92=>'CN',
						93=>'CO', 94=>'CP', 95=>'CQ', 96=>'CR', 97=>'CS', 98=>'CT', 99=>'CU',
						100=>'CV', 101=>'CW', 102=>'CX', 103=>'CY', 104=>'CZ', 105=>'DA', 106=>'DB');
    /**
     *生成Excel 2007 并输出到浏览器上 
     *@param 表头内容
     *@data  输出数据
     *结果输入Excel在页面上   
     */
    function writer($title='',$data='')
    {   
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();
        // Set properties
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
        							 ->setLastModifiedBy("Maarten Balliauw")
        							 ->setTitle("Office 2007 XLSX Test Document")
        							 ->setSubject("Office 2007 XLSX Test Document")
        							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
        							 ->setKeywords("office 2007 openxml php")
        							 ->setCategory("Test result file");
        
        //表头循环
        foreach ($title as $tkey => $tvalue)
        {
            $tkey = $tkey+1;   
            $row  = $this->cellArray[$tkey].'1';     //组合行数（开始是第一行）
            // Add some data  //表头
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $tvalue);
        
        }
        // Miscellaneous glyphs, UTF-8
        
        //内容循环
            
            foreach($data as $key =>$value) 
            {   
                $i = 1;
                foreach ($value as $mkey =>$mvalue)
                {   
                    $rows = $key+2; //开始是第二行
                    $mrow = $this->cellArray[$i].$rows;
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($mrow, $mvalue);  
                    $i++; 
                }
              
            }
       // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('Simple');
        
        
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        
        
        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="MyExcel.xlsx"');
        header('Cache-Control: max-age=0');
        
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }
    
    /**
     * 读取Excel
     * @param  Excel文件名称 
     * @param  返回数据的键名 
     * @return data   
     */ 
	 // phpExcel轉日期函式
  
    function read($fileName,$rows='')
    {   
        //$fileName      = "ExcelFile/MyExcel.xlsx";
        $objReader     = new PHPExcel_Reader_Excel2007();
        $objPHPExcel   = $objReader->load("$fileName");
        $sheet         = $objPHPExcel->getActiveSheet();
        $highestRow    = $sheet->getHighestRow();           // 取得总行数  
        $highestColumn = $sheet->getHighestColumn();       // 取得总列数D
        
        $rowMin = array_search($highestColumn,$this->cellArray); //根据返回的总列数D 返回对用的KEY
     //   $rowMin = $rowMin - 1;     //key 2個欄位時使用   getValue()  getFormattedValue();  解决科学计数法的问题
	    //   return $rowMin;
		$tempArray = array();  
		
        for($i = 2;$i<=$highestRow;$i++)                   //循环总行数
        {   
            for($a = 1;$a<=$rowMin;$a++)                   //循环总列数 
            {     
                 if(empty($rows))
                 {
                    $data[$i][$a] = $sheet->getCell($this->cellArray[$a].$i)->getValue(); 
                   				
                 }
                 else
                 {
					//$days = $sheet->getCellByColumnAndRow($i, 0)->getValue();
					//$day2 =excelTime($days,true);
                    $data[$i][$rows[$a-1]] = $sheet->getCell($this->cellArray[$a].$i)->getValue();  
				//	if ($a==4){
                 //   return $data[2][$rows[$a-1]];}	
				//  $tempArray[] = excelTime($objPHPExcel->getActiveSheet()->getCell($this->cellArray[$a].$i)->getValue());
				     $cell =$sheet->getCell($this->cellArray[$a].$i); 
					 $value=$cell->getValue();
				     if($cell->getDataType()==PHPExcel_Cell_DataType::TYPE_NUMERIC){  
	                    $cellstyleformat=$cell->getParent()->getStyle( $cell->getCoordinate() )->getNumberFormat();  
                    $formatcode=$cellstyleformat->getFormatCode();  
                   if (preg_match('/^(\[\$[A-Z]*-[0-9A-F]*\])*[hmsdy]/i', $formatcode)) {  
	                       $value=gmdate("Y-m-d H:i:s", PHPExcel_Shared_Date::ExcelToPHP($value)); 
                           $data[$i][$rows[$a-1]]=$value;						   
                   }else{  
	                        $value=PHPExcel_Style_NumberFormat::toFormattedString($value,$formatcode);
                           	$data[$i][$rows[$a-1]]=$value;						
	                    }
					 }  
				   
                    if 	($data[$i][$rows[$a-1]]==''){$data[$i][$rows[$a-1]]=' ';}
                    if 	($data[$i][$rows[$a-1]]=='0') {$data[$i][$rows[$a-1]]='-';}					
                 }
                    
            }  
        }
        return $data;
    }
}

//$Excel = new Excel();
//$Excel->read();
//$Excel->writer();
