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
			
			$this->db->where('te200 > ', '');
		    $this->db->delete('palte1'); 
			 $filePath = dirname(dirname(dirname(dirname(__FILE__))))."/uploadtxt/";  //上傳文件的路徑 
			 $txt=$filePath.$filename;
			 $txt = file_get_contents($txt);

             $txt = str_replace( "\r", "",$txt);

             $txt = preg_split('/\n/', $txt, -1, PREG_SPLIT_NO_EMPTY);
				
             $sql = "INSERT INTO palte1 (te200) VALUES ";
             foreach($txt as $k=>$v){
			 if($k>0){$sql .= ",";}
			   $str = $v;
               $sql .= "('$str') ";
             }
             $this->db->query($sql);
			 // 刷卡定義取出員工代號,日期,時間
			  $query = $this->db->query("SELECT * FROM palmn  ");         
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
    /*while($row=mysql_fetch_assoc($result)){
        foreach($row as $i=>$v){
            $$i=$v;
        }*/
	$this->db->select('mv001,mv028');    //查詢數
	$this->db->from('cmsmv');
	$this->db->where('mv022',"");
	$temp_ary = $this->db->get()->result_array();
	$match_ary = array();
	foreach($temp_ary as $key => $val){
		if(!@$val['mv028']){
			$match_ary[$val['mv001']] = $val['mv001'];
		}
		else{
			$match_ary[$val['mv028']] = $val['mv001'];
		}
	}
	$total = count($txt);$now_count = 0;
	foreach($txt as $key=>$val){$now_count++;
		$te200 = trim($val);
		//刷卡檔  palte  商合palmn 6,11,17,20,21,22,23,24,12,14,15,16,25,25
		$te000 = substr($te200,0,2);
		$te001 = substr($te200,$vmn002,$vmn003);
		$te002 = substr($te200,$vmn004,$vmn009);
		$te003 = substr($te200,$vmn010,$vmn013);
		$te004 = $te001;
		$te006 = substr($te200,$vmn004,$vmn009);
		$te007 = substr($te200,$vmn014,$vmn015);
		if(@$match_ary[$te001]){$te001 = $match_ary[$te001];}
		//if ($te001=='107011') {var_dump($te001);exit;}
		//if ($te001=='07011') {var_dump($te001);exit;}
		$data1 = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'te001' => $te001,  //員工代號3    6
		         'te002' => $te002,  //刷卡日9      8
		         'te003' => $te003,   //刷卡時間13  4
		         'te004' => $te004,   //刷卡卡號   6
				 'te005' => 'N',
				 'te006' => $te006,   //歸屬日9     8
			     'te007' => $te007     //功能碼15  1
                );	
				
			$exist = $this->palb51_model->selone2($te001,$te002,$te003);
		  if ($exist)
		    {
			 $this->db->where('te001', $te001);
			 $this->db->where('te002', $te002);
			 $this->db->where('te003', $te003);
			 $this->db->update('palte', $data1);
		    }else {       
			  if ($te000!='08') {
              $this->db->insert('palte', $data1); }      //新增一筆  
	        }
			$exist = $this->palb51_model->selone3($te001,$te002,$te003);
		  if ($exist)
		    {
			 $this->db->where('te001', $te001);
			 $this->db->where('te002', $te002);
			 $this->db->where('te003', $te003);
			 $this->db->update('palte2', $data1);
		    }else {     
              if ($te000!='08') {			
              $this->db->insert('palte2', $data1); }     //新增一筆 
	        }
			//遲到次數 1060829
			$exist = $this->palb51_model->selone5($te001,$te002,$te003);
		  if ($exist)
		    {
			 $this->db->where('te001', $te001);
			 $this->db->where('te002', $te002);
			 $this->db->where('te003', $te003);
			 if ($te003>='0801'   and $te003<='0805') {
			     $this->db->update('palte5', $data1); }
		    }else {    
			   if ($te003>='0801' and $te003<='0805' and $te000!='08' ) {
			     $this->db->insert('palte5', $data1); }      //新增一筆 
	        }
	     /*$sql53 = " UPDATE `palte` AS A,  
			(SELECT mv001,mv028  FROM `cmsmv` GROUP BY `mv001`) AS B  
			SET A.`te001`=B.`mv001`
			WHERE A.`te004`=B.`mv028` and A.`te001` = ".$te001." and A.`te002` = ".$te002." and A.`te003` = ".$te003;
			
			$this->db->query($sql53);*/
		//if($now_count == 10){echo "<pre>";var_dump($this->db);var_dump($txt);exit;}
		//echo "<script>console.log('".$now_count."/".$total."')</script>";
    }
	  //員工代號置換 (卡號)
			 
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
     //查複製資料是否重複	 
    function selone3($seg1,$seg2,$seg3)    
        { 	
	      $this->db->where('te001', $seg1);     
	      $this->db->where('te002', $seg2);
		  $this->db->where('te003', $seg3);
	      $query52 = $this->db->get('palte2');
	      return $query52->num_rows() ; 
	    }
	 //查複製資料是否重複	 palte5 遲到次數
    function selone5($seg1,$seg2,$seg3)
        { 	
	      $this->db->where('te001', $seg1);     
	      $this->db->where('te002', $seg2);
		  $this->db->where('te003', $seg3);
	      $query52 = $this->db->get('palte5');
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