<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Taxb03_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  
	
//計算 進銷項媒體檔
	function batchaf()
        {
			
		  $seq1=$this->input->post('cmsi11');
		  $seq3=substr($this->input->post('dateo'),0,4).substr($this->input->post('dateo'),5,2);
	   	  $seq4=substr($this->input->post('datec'),0,4).substr($this->input->post('datec'),5,2);
		  //刪除計算當
		   $this->db->where('mj001', $seq1);
		   $this->db->where('mj002', $seq3);
		   $this->db->delete('taxmj'); 
		
			
		  //統計檔 taxmj 
		       $sql2 = "INSERT INTO taxmj (mj001,mj002,mj004,mj005,mj006,mj007,mj008,mj009,mj010,mj011,mj012,mj013,mj014,mj022,mj023) 
		           SELECT  $seq1 as aa1,$seq3 as aa2,mc004,mc005,mc006,mc007,mc008,mc009,mc010,mc011,mc012,mc013,mc014,mc022,mc023
		   FROM taxmc1 as a  WHERE mc001='$seq1' AND mc002='$seq3'
		               GROUP BY	mc001,mc002 "; 
		    $this->db->query($sql2);
			
				 // 產生文字檔 
			$filePath = dirname(dirname(dirname(dirname(__FILE__))))."/uploadtxt/";  //上傳文件的路徑 
			$txtfilename=$filePath.'invotax'.'.txt';
          //  touch($txtfilename); //建立檔案 
		  
			 if(is_file($txtfilename))
                unlink($txtfilename); // delete file
               
			
			$sql="select * from taxmj  ";
		  //  $result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
		    $temp_count = 0;
			$query = $this->db->query($sql) ;
		foreach ($query->result() as $row) {
		  //  while($row=mysql_fetch_assoc($result)){
			   $temp_count ++;
			  foreach($row as $i=>$v){
				$$i=$v;
			  }
  			   $savedata = $mj001.$mj002.$mj004.$mj005.$mj006.$mj007.$mj008.$mj009.$mj010.$mj011.$mj012.$mj013.$mj014.$mj022.$mj023."\n"  ; 
			  $savedata = iconv("UTF-8","big5",$savedata); // utf8轉BiG5
			 
			     if(@$fp = fopen($txtfilename, 'a+')) //開啟只有寫入的檔案，並將檔案長度設為零；如果檔案不存在，則建立 
                { 
	              fwrite($fp, $savedata); //寫入 
	              fclose($fp);
	            } 
			   
			 /*  header("Content-type:application");
               header("Content-Length: " .(string)(filesize($file)));
               header("Content-Disposition: attachment; filename=".$file);
               readfile($file); */


			}
			   header("Content-type: text/html; charset=utf-8");
				$file="$txtfilename"; // 實際檔案的路徑+檔名
                $filename="invotax.txt"; // 下載的檔名
			   header("Content-type: ".filetype("$file"));
               header("Content-Disposition: attachment; filename=".$filename."");
               readfile($file);
			
		  return true;	
    } 
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>