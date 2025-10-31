<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Palb51_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
		  $this->load->database();
       }	

    /**
    * 增加
    * @param 姓名
    * @param 性别
    * @param 电话
    * @return bool
    */ 
	//新增一筆	
	function insertf($filename)    
        {
			
			$this->db->where('te200 >=', '0');
		    $this->db->delete('palte1'); 
			 $filePath = dirname(dirname(dirname(dirname(__FILE__))))."/uploadtxt/";  //上傳文件的路徑 
			 $txt=$filePath.$filename;
			 $txt = file_get_contents($txt);

             $txt = str_replace( "\r", "",$txt);

             $txt = preg_split('/\n/', $txt, -1, PREG_SPLIT_NO_EMPTY);

             foreach($txt as $k=>$v){

             if($k!=0){//判斷是否為第一行

            // $str = explode('|',$v);//「|」數據分隔符
			   $str = $v;
               $sql = "INSERT INTO palte1 (te200) VALUES ('$str') ";
               $this->db->query($sql);
             }
             }
			 // 刷卡定義取出員工代號,日期,時間
			  $query = $this->db->query("SELECT *  FROM palmn  ");         
		foreach ($query->result() as $row)
            {
            $mn002[]=$row->mn002;
			$mn003[]=$row->mn003;
			$mn004[]=$row->mn004;
			$mn009[]=$row->mn009;
			$mn010[]=$row->mn010;
			$mn013[]=$row->mn013;
			$mn014[]=$row->mn014;
			$mn015[]=$row->mn015;
            }
			$vmn002=$mn002[0];
			$vmn003=$mn003[0];
			$vmn004=$mn004[0];
			$vmn009=$mn009[0];
			$vmn010=$mn010[0];
			$vmn013=$mn013[0];
			$vmn014=$mn014[0];
			$vmn015=$mn015[0];
	       // insert to palte 
		   $sql51="select te200 from `palte1` ";
	$result = mysql_query($sql51) or die_content("查詢資料失敗".mysql_error());
    while($row=mysql_fetch_assoc($result)){
        foreach($row as $i=>$v){
            $$i=$v;
        }
		  
				//刷卡檔  palte  商合palmn 6,11,17,20,21,22,23,24,12,14,15,16,25,25
		$data1 = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'te001' => substr($te200,$vmn002,$vmn003),  //員工代號3    6
		         'te002' => substr($te200,$vmn004,$vmn009),  //刷卡日9      8
		         'te003' => substr($te200,$vmn010,$vmn013),   //刷卡時間13  4
		         'te004' => substr($te200,$vmn002,$vmn003),   //刷卡卡號   6
				 'te005' => 'N',
				 'te006' => substr($te200,$vmn004,$vmn009),   //歸屬日9     8
			     'te007' => substr($te200,$vmn014,$vmn015)     //功能碼15  1
                );	
			$exist = $this->palb51_model->selone2(substr($te200,$vmn002,$vmn003),substr($te200,$vmn004,$vmn009),substr($te200,$vmn010,$vmn013));
		  if ($exist)
		    {
			 $this->db->where('te001', substr($te200,$vmn002,$vmn003));
			 $this->db->where('te002', substr($te200,$vmn004,$vmn009));
			 $this->db->where('te003', substr($te200,$vmn010,$vmn013));
			 $this->db->update('palte', $data1);
		    }  else {       
              $this->db->insert('palte', $data1);      //新增一筆  
	         }	
		  
    }
	  //員工代號置換 (卡號)
	     $sql53 = " UPDATE  `palte` AS A,  
       (SELECT mv001,mv028  FROM `cmsmv` GROUP BY `mv001`) AS B  
    SET A.`te001`=B.`mv001`
    WHERE A.`te004`=B.`mv028`   "; 
			 $this->db->query($sql53);
			 
		  return true;	
  } 
	     
     //查複製資料是否重複	 
    function selone2($seg1,$seg2,$seg3)    
        { 	
	      $this->db->where('te001', $seg1);     
	      $this->db->where('te002', $seg2);
		  $this->db->where('te003', $seg3);
	      $query52 = $this->db->get('palte');
	      return $query52->num_rows() ; 
	    }
    /**
     *查询表中的全部数据 
     *@return data
     */
     function selUsers()
      {
		$this->db->select('*');    //查詢數
	    $this->db->from('mymta');		
        $query = $this->db->get();
        return $query->result_array();
      } 
}
?>