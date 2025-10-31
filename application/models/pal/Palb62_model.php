<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class palb62_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//計算扣繳憑單媒體申報
	function batchaf()           
        {
		  $vyy=substr($this->input->post('ta034c'),0,4);
		  $seq3=substr($this->input->post('dateo'),0,4).substr($this->input->post('dateo'),5,2);
	   	  $seq4=substr($this->input->post('datec'),0,4).substr($this->input->post('datec'),5,2);
		  $seq5=$this->input->post('ml008');
		  //刪除計算當
		   $this->db->where('my002', $seq3);
		   $this->db->delete('palmy1'); 
		
			$sql = "SELECT IFnull(b.ml008,d.ti012) as ml008,d.ti012,a.td005,a.td001,a.td002,a.td004,c.mv009
					,(a.td030-a.td049) as td030_1,b.ml007,a.td030,td035,td044,(a.td030-a.td049-a.td044) as td030_2,a.td011 FROM paltd as a
					LEFT JOIN ( SELECT MAX(create_date) as create_date,ml001,ml007,ml008
					  FROM palml 
					  GROUP BY create_date,ml001
					)
					as b ON a.td001 = b.ml001 
					LEFT JOIN cmsmv as c ON a.td001 = c.mv001
					LEFT JOIN palti as d ON a.td001 = d.ti001
					WHERE a.td005 = '$seq3' ";//低於基本薪資不用顯示
			
			if(@$seq5){
				$sql.=" and ( ml008 = '".$seq5[0]."' ";
				foreach($seq5 as $key => $val){
					$sql .= " or ml008 = '".$val."'";
				}
				$sql.=" ) ";
			}
			$sql .= " GROUP BY b.ml001 ORDER BY ml008 ASC,c.mv004 ASC,c.mv001 ASC,b.create_date DESC";
		  
			$result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
		$temp_count = 0;
		while($row=mysql_fetch_assoc($result)){
			$temp_count ++;
			foreach($row as $i=>$v){
				$$i=$v;
			} 
		
			$data1 = array(
		         'my001' => $ml008,
				 'my002' => $td005,
				 'my003' => $td001,
				 'my004' => $td002,
				 'my005' => $td004,
				 'my006' => $mv009,
				 'my007' => $td030_1,
				 'my008' => $ml007,
				 'my009' => $td030,
				 'my010' => $td035,
				 'my011' => $td044,
				 'my012' => $td030_2,
				 'my013' => $td011
                );      
			   $this->db->insert('palmy1', $data1);
			
		}
		  //統計檔 palmy
		      
				 // 產生文字檔 
			$filePath = dirname(dirname(dirname(dirname(__FILE__))))."/uploadtxt/";  //上傳文件的路徑 
			$txtfilename=$filePath.'healthitax'.'.txt';
            touch($txtfilename); //建立檔案 
		  
			 if(is_file($txtfilename))
                unlink($txtfilename); // delete file
               
			
			$sql="select * from palmy1  ";
		    $result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
		    $temp_count = 0;
		    while($row=mysql_fetch_assoc($result)){
			   $temp_count ++;
			  foreach($row as $i=>$v){
				$$i=$v;
			  }
  			   $savedata = $my001.$my002.$my003.$my004.$my005.$my006.$my007.$my008.$my009.$my010.$my011."\n"  ; 
			   $savedata = iconv("UTF-8","big5",$savedata); // utf8轉BiG5
			 
			     if(@$fp = fopen($txtfilename, 'a+')) //開啟只有寫入的檔案，並將檔案長度設為零；如果檔案不存在，則建立 
                { 
	              fwrite($fp, $savedata); //寫入 
	              fclose($fp); 
	            } 
			 
              
			}
			  
				header("Content-type: text/html; charset=utf-8");
				$file="$txtfilename"; // 實際檔案的路徑+檔名
                $filename="healthitax.txt"; // 下載的檔名
			    @header("Content-type: ".filetype("$file"));
                @header("Content-Disposition: attachment; filename=".$filename."");
               readfile($file);
		  return true;	
    } 
	
	//列出類別
	function printcol()
        {
	      $this->db->select('mm001, mm002, mm003');
          $this->db->from('palmm');
	      $this->db->order_by('mm001 ASC, mm002 ASC');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('palmm');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;
        }
	
 	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>