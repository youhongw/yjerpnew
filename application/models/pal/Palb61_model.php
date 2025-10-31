<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Palb61_model extends CI_Model {
	
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
		  //刪除計算當
		   $this->db->where('mx001', $vyy);
		   $this->db->delete('palmx'); 
		  
		/*   $sql = " SELECT $vyy,'52',a.td001,a.td002,b.mv009,b.mv017,$seq3,$seq4,sum(td047) as td047,sum(td037) as td037,sum(td047)-sum(td037) as td099
		   FROM paltd as a 
		   LEFT JOIN cmsmv as b on a.td001=b.mv001 
		               WHERE td005>='$seq3' AND td005<='$seq4'  
                         "; 
		  
		  $sql .= " GROUP BY  a.td001,a.td002,b.mv009,b.mv017 ";  
		  
		  $query = $this->db->query($sql);  */
			
		  //統計檔 palmx 
		       $sql2 = "INSERT INTO palmx (mx001,mx002,mx003,mx004,mx005,mx006,mx007,mx008,mx009,mx010,mx011) 
		           SELECT  $vyy as aa1,'52' as aa2,a.td001,a.td002,b.mv009,b.mv017,$seq3 as aa3,$seq4 as aa4,sum(td047) as td047,sum(td037) as td037,sum(td047)-sum(td037) as td099
		   FROM paltd as a 
		   LEFT JOIN cmsmv as b on a.td001=b.mv001 WHERE td005>='$seq3' AND td005<='$seq4'
		               GROUP BY	aa1,aa2,a.td001,a.td002,b.mv009,b.mv017,aa3,aa4 "; 
		    $this->db->query($sql2);
				 // 產生文字檔 
			$filePath = dirname(dirname(dirname(dirname(__FILE__))))."/uploadtxt/";  //上傳文件的路徑 
			$txtfilename=$filePath.'voucherstax'.'.txt';
          //  touch($txtfilename); //建立檔案 
		  
			 if(is_file($txtfilename))
                unlink($txtfilename); // delete file
               
			
			$sql="select * from palmx  ";
		    $result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
		    $temp_count = 0;
		    while($row=mysql_fetch_assoc($result)){
			   $temp_count ++;
			  foreach($row as $i=>$v){
				$$i=$v;
			  }
  			   $savedata = $mx001.$mx002.$mx003.$mx004.$mx005.$mx006.$mx007.$mx008.$mx009.$mx010.$mx011."\n"  ; 
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
                $filename="voucherstax.txt"; // 下載的檔名
			   header("Content-type: ".filetype("$file"));
               header("Content-Disposition: attachment; filename=".$filename."");
               readfile($file);
			
		  return true;	
    } 
	
	
 	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>