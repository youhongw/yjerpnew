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
//require_once 'PHPExcel.php';
//require_once 'PHPExcel/IOFactory.php';
/**
 * 輸出到頁面上的EXCEL
 * 
 * 
 */ 
class Excel
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
     *產生 Excel 2007 併輸出到瀏覽器上 
     *@param 表頭内容
     *@data  输出資料例內容
     *结果輸入 Excel 在頁面上   
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
        
        //表頭循環
        foreach ($title as $tkey => $tvalue)
          {
            $tkey = $tkey+1;   
            $row  = $this->cellArray[$tkey].'1';     //组合行數（开始是第一行）
            // Add some data  //表頭
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $tvalue);
          }
        // Miscellaneous glyphs, UTF-8
        
        //内容循環
        foreach($data as $key =>$value) 
           {   
              $i = 1;
              foreach ($value as $mkey =>$mvalue)
                {   
                   $rows = $key+2; //開始是第二行
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
        header('Content-Disposition: attachment;filename="Excel_'.date('Ymd').'.xlsx"');
        header('Cache-Control: max-age=0');
        
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	 //   $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
      }
    
    /**
     * 讀取Excel
     * @param  Excel文件名稱 
     * @param  返回數据的鍵名 
     * @return data   
     */ 
    function read($fileName='MyExcel.xlsx',$rows='')
      {   
        //$fileName      = "ExcelFile/MyExcel.xlsx";
        $objReader     = new PHPExcel_Reader_Excel2007();
        $objPHPExcel   = $objReader->load("$fileName");
        $sheet         = $objPHPExcel->getActiveSheet();
        $highestRow    = $sheet->getHighestRow();           // 取得總行數  
        $highestColumn = $sheet->getHighestColumn();       // 取得總列數
        $rowMin = array_search($highestColumn,$this->cellArray); //根据返回的總列數資料 返回對照的KEY
        
        for($i = 2;$i<=$highestRow;$i++)                   //循環總行數
          {   
            for($a = 1;$a<=$rowMin;$a++)                   //循環總列數 
             {     
               if(empty($rows))
                 {
                   $data[$i][$a] = $sheet->getCell($this->cellArray[$a].$i)->getValue();      
                 }
               else
                 {
                   $data[$i][$rows[$a-1]] = $sheet->getCell($this->cellArray[$a].$i)->getValue();         
                 }
            }  
          }
        return $data;
      }
	  
	  
	/**
     *產生 Excel 2007 併輸出到瀏覽器上 
     *@param 表頭内容
     *@data  输出資料例內容
     *结果輸入 Excel 在頁面上
	 *特殊處理	Talence Editor 2017.03.16
     */
    function writer_special($title='',$data='',$filename='',$width_ary='',$height_ary='')
      {   
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();
        // Set properties
        $objPHPExcel->getProperties()->setCreator("Dersheng")
        		         ->setLastModifiedBy("Dersheng")
        			     ->setTitle("Office 2007 XLSX Test Document")
        			     ->setSubject("Office 2007 XLSX Test Document")
        			     ->setDescription("Dersheng document for Office 2007 XLSX, generated using PHP classes.")
        			     ->setKeywords("office 2007 openxml php")
        			     ->setCategory("Dersheng report");
        
        //表頭循環
        foreach ($title as $tkey => $tvalue)
          {
            $tkey = $tkey+1;   
            $row  = $this->cellArray[$tkey].'1';     //组合行數（开始是第一行）
            // Add some data  //表頭
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $tvalue);
          }
        // Miscellaneous glyphs, UTF-8
        
        //内容循環
        foreach($data as $key =>$value) 
           {   
              $i = 1;
              foreach ($value as $mkey =>$mvalue)
                {   
                   $rows = $key+2; //開始是第二行
                   $mrow = $this->cellArray[$i].$rows;
                   $objPHPExcel->setActiveSheetIndex(0)->setCellValue($mrow, $mvalue);  
                   $i++; 
                }
            }
			
		//修改儲存格格式
		
		if(is_array ($width_ary)) {
			foreach($width_ary as $k=>$v){
				$tkey = $k+1;
				if(@$width_ary[$k]&&$width_ary[$k]>0){
					$objPHPExcel->getActiveSheet()->getColumnDimension($this->cellArray[$tkey])->setWidth($width_ary[$k]);
					//$objPHPExcel->getActiveSheet()->getComment('F22')->setHeight('20');
				}else{
					$objPHPExcel->getActiveSheet()->getColumnDimension($this->cellArray[$tkey])->setAutoSize(true);
				}
			}
		}
		
		if(is_array ($height_ary)) {
			$position = $height_ary[0];
			$per_row = $height_ary[1];
			$height = $height_ary[2];
			$last_col = $this->cellArray[$tkey];
			//$height = array(array(1,5),5,45);
			//$objPHPExcel->getActiveSheet()->mergeCells('G1:G22');//it works
			for($i=0;$i<=$key;$i++){
				$now_row = $i+2;
				foreach($position as $p_k=>$p_v){
					if(($now_row-1-$p_v)%$per_row==0){
						$objPHPExcel->getActiveSheet()->getRowDimension($now_row)->setRowHeight($height);//works
						$position_str = "A".$now_row.":".$last_col.$now_row;
						$objPHPExcel->getActiveSheet()
						->getStyle($position_str)
						->getAlignment()
						->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					}
				}
			}
			
		}
		
       // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('Simple');
        
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        
        // Redirect output to a client’s web browser (Excel2007)
		if(!@$filename){$filename="Excel_".date('Ymd');}
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
        header('Cache-Control: max-age=0');
        
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	 //   $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
      }
}
/* useful funcs

//$objPHPExcel->getActiveSheet()->mergeCells('G1:G22');//it works
$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(45);//works
$objPHPExcel->getActiveSheet()->getRowDimension(6)->setRowHeight(45);//works

$objPHPExcel->getActiveSheet()
->getStyle('A2:J2')
->getAlignment()
->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()
->getStyle('A6:J6')
->getAlignment()
->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

//align WORKS !!
$objPHPExcel->getActiveSheet()
->getStyle('A8:F8')
->getAlignment()
->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
*/
//$Excel = new Excel();
//$Excel->read();
//$Excel->writer();
