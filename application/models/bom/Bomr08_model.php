<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bomr08_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
		//  $base_bom_list[0]['bom_base'] = $base_item['$md002'];
		   $md002='1000';
		   $base_bom_list[0]['bom_base'] = $md002;
	       $level_count = 0;
	       $totle_count = 0;
	       $base_bom_list = array();
		   $row_temp = array();
		   $base_item=array();  //md001
		   $temp_list=array();   //md001
        }
	
	function return_count(){
		global $totle_count;
		return $totle_count;
	}
	function check_have_bom($temp_item){
		if(!$temp_item['md001'])
			return 0;
		$sql = "select md001 from bommd where md001 = '".$temp_item['md001']."'";
		$result = mysql_query($sql);
		$result = $this->db->query($sql) ;
		//if($row = mysql_fetch_array($result
		if(!$result->result_array())
			return 1;
		else
			return 0;
	}
	
	function get_bom_list_out($invq02a){
		
		$sql1 = "SELECT MC001 FROM BOMMC WHERE MC001 ='$invq02a' ";
		
		$query = $this->db->query($sql1);
		$result['rows'] = $query->result();
		
		$sql = "EXEC PRO_BOMMD_R @MC001 = '$invq02a'";
		$query2 = $this->db->query($sql);
		
		$sql2 = "SELECT MD001,MD003,DP,MB002,MB003,MB004,MD005,MB025,MD007,MD006,MB057,MB058,MB061,MB059,MB062,MB060,MB063,MB064,MB065 FROM V_BOMMD_R";
			
		//echo var_dump($sql2);exit;
		$query1 = $this->db->query($sql2);
		//echo var_dump($query1);exit;

		$result['rows1'] = $query1->result();
		
		
		return $result;
		/*
		$level_count = 0;
		//$temp_list_item = $this->get_item_data($temp_list);
		$sql = "select a.md001,a.md002,a.md003,a.md004,a.md005,a.md006,a.md016,b.mb002,b.mb003,b.mb025,c.mc004 from bommd as a,invmb as b,bommc as c where a.md001 = c.mc001 and a.md003=b.mb001 and a.md001 = '".$temp_list."' order by a.md001,a.md002 ";
		//$result = mysql_query($sql);
		$result = $this->db->query($sql) ;
		//$row_temp = mysql_fetch_array($result);
		foreach ($result->result_array() as $row_temp){}
		$temp_list_item = $row_temp;
		$temp_item = $this->get_item_data($temp_list);
		$temp_list_item['mb001'] = $temp_item['mb001'];unset($temp_list_item[0]);
		$temp_list_item['mb002'] = $temp_item['mb002'];unset($temp_list_item[1]);
		$temp_list_item['mb003'] = $temp_item['mb003'];unset($temp_list_item[2]);
		$temp_list_item['mb004'] = $temp_item['mb004'];unset($temp_list_item[3]);
		$temp_list_item['mb025'] = $temp_item['mb025'];unset($temp_list_item[4]);
		$temp_list_item['mb057'] = $temp_item['mb057'];unset($temp_list_item[5]);
		$temp_list_item['mb058'] = $temp_item['mb058'];unset($temp_list_item[6]);
		$temp_list_item['mb059'] = $temp_item['mb059'];unset($temp_list_item[7]);
		$temp_list_item['mb060'] = $temp_item['mb060'];unset($temp_list_item[8]);
		$temp_list_item['mc004'] = number_format($temp_list_item['mc004'],4);
		$temp_list_item['md006'] = number_format($temp_list_item['md006'],4);
		$temp_list_item['level'] = "0";
		$base_bom_list = $this->get_bom_list($temp_list_item);
		
		return $base_bom_list;
		*/
	}
	
	function get_bom_list($temp_list)          //get_bom_list  遞廻$m_count,$base_bom_list,$row_temp,$vmd003
    {
	    global $level_count,$row_temp;
		$sql = "select a.md001,a.md002,a.md003,a.md004,a.md005,a.md006,a.md016,b.mb002,b.mb003,b.mb025,c.mc004 from bommd as a,invmb as b,bommc as c where a.md001 = c.mc001 and a.md003=b.mb001 and a.md001 = '".$temp_list['md001']."' order by a.md001,a.md002 ";
		//$result = mysql_query($sql);
		$result = $this->db->query($sql) ;
		$count_temp = 0;
		
	//	$temp_list = array();
		$level_count++;                   //階層
		
		//while($row_temp = mysql_fetch_array($result)){
			foreach ($result->result_array() as $row_temp){
			$temp_list["bom_list"][$count_temp] = $this->get_item_data($row_temp['md003']);unset($temp_list["bom_list"][$count_temp][0]);
			$temp_list["bom_list"][$count_temp]["md002"] = $row_temp['md002'];unset($temp_list["bom_list"][$count_temp][1]);
			$temp_list["bom_list"][$count_temp]["md003"] = $row_temp['md003'];unset($temp_list["bom_list"][$count_temp][2]);
			$temp_list["bom_list"][$count_temp]["md004"] = $row_temp['md004'];unset($temp_list["bom_list"][$count_temp][3]);
			$temp_list["bom_list"][$count_temp]["md005"] = $row_temp['md005'];unset($temp_list["bom_list"][$count_temp][4]);
			$temp_list["bom_list"][$count_temp]["md006"] = number_format($row_temp['md006'],4);unset($temp_list["bom_list"][$count_temp][5]);
			$temp_list["bom_list"][$count_temp]["md016"] = $row_temp['md016'];unset($temp_list["bom_list"][$count_temp][6]);
			$temp_list["bom_list"][$count_temp]["mb025"] = $row_temp['mb025'];unset($temp_list["bom_list"][$count_temp][7]);
			$temp_list["bom_list"][$count_temp]['mc004'] = number_format($row_temp['mc004'],4);unset($temp_list["bom_list"][$count_temp][8]);
			$temp_list["bom_list"][$count_temp]['level'] = '';
			//echo "<pre>"; var_dump($temp_list["bom_list"][$count_temp]);exit;
			for($i=0;$i<$level_count;$i++){
				$temp_list["bom_list"][$count_temp]['level'] .= ".";
			}
			$temp_list["bom_list"][$count_temp]['level'] .= $level_count;

			if($this->check_have_bom($temp_list["bom_list"][$count_temp])){
				$temp_list["bom_list"][$count_temp] = $this->get_bom_list($temp_list["bom_list"][$count_temp]);
			}

			$count_temp++;
		}
		$level_count -= 1;
		return $temp_list;
		
	/*	while($row_temp = mysql_fetch_array($result)){    //用temp裝一遍 3筆$result
			$temp_list[$count_temp]=$row_temp;
			$count_temp++;
		}
		//再送上base，有才裝 $val['md003']  $val->md003
		//echo '<pre>';var_dump($temp_list);
	    if($temp_list)
		     $base_bom_list[$level_count] = $temp_list ;
		foreach($temp_list as $val){
		 	//get_bom_list($val['md003']);
		}   
		return $temp_list;    */ 
	}
	
	function get_item_data($temp_it_id){
		global $totle_count;
		$sql = "select mb001,mb002,mb003,mb004,mb025,mb057,mb058,mb059,mb060 from invmb where mb001 = '$temp_it_id'";
		//$result = mysql_query($sql);
		$result = $this->db->query($sql);
		//$temp_row = mysql_fetch_array($result);
		foreach ($result->result_array() as $temp_row)
          {
			  $temp_row['md001'] = $temp_row['mb001'];
		  }
		//echo "<pre>";var_dump($temp_row);exit;
		//$temp_row['md001'] = $temp_row['mb001'];
		$totle_count++;
		return $temp_row;
	}
	
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS tg001disp, d.me002 AS tg004disp, e.mb002 AS tg010disp, f.mv002 AS tg012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th011, b.th009, b.th017, b.th018, b.th012');
		 
        $this->db->from('coptg as a');	
        $this->db->join('copth as b', 'a.tg001 = b.th001  and a.tg002=b.th002 ','left');		
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.tg004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.tg010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.tg012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.tg001', $this->uri->segment(4)); 
	    $this->db->where('a.tg002', $this->uri->segment(5)); 
		$this->db->order_by('tg001 , tg002 ,b.th003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('th001', $this->uri->segment(4));
		$this->db->where('th002', $this->uri->segment(5));
	    $query = $this->db->get('copth');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆 A4
	function printfc()   
      {           
          $this->db->select('a.* ,c.mq002 AS tg001disp, d.mb002 AS tg010disp,e.mf002 AS tg011disp, f.mv002 AS tg006disp,g.na003 AS tg047disp,
		  ,h.ma002 AS tg004disp,h.ma006 as tg004disp1,h.ma008 as tg004disp2,h.ma005 as tg004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th016,b.th017,b.th018,b.th019,b.th031,i.mc002 as th007disp,j.me002 as tg005disp');
		 
        $this->db->from('coptg as a');	
        $this->db->join('copth as b', 'a.tg001 = b.th001  and a.tg002=b.th002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tg010 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tg011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tg006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tg047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tg004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tg005 = j.me001 ','left');   //部門
		$this->db->where('a.tg001', $this->input->post('tg001o')); 
	    $this->db->where('a.tg002', $this->input->post('tg002o')); 
		$this->db->order_by('tg001 , tg002 ,b.th003');
		
		$query = $this->db->get();
	    $result['rows'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result;
		 }
      }
	  
	//印單據筆  半張紙letter1/2 A4half
		function printfb()   
        {           
          $this->db->select('a.* ,c.mq002 AS tg001disp, d.mb002 AS tg010disp,e.mf002 AS tg011disp, f.mv002 AS tg006disp,g.na003 AS tg047disp,
		  ,h.ma002 AS tg004disp,h.ma006 as tg004disp1,h.ma008 as tg004disp2,h.ma005 as tg004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th016,b.th017,b.th018,b.th019,b.th031,i.mc002 as th007disp,j.me002 as tg005disp');
		 
        $this->db->from('coptg as a');	
        $this->db->join('copth as b', 'a.tg001 = b.th001  and a.tg002=b.th002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tg010 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tg011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tg006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tg047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tg004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tg005 = j.me001 ','left');   //部門
		$this->db->where('a.tg001', $this->uri->segment(4)); 
	    $this->db->where('a.tg002', $this->uri->segment(5)); 
		$this->db->order_by('tg001 , tg002 ,b.th003');
		
		$query = $this->db->get();
	    $result['rows'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result;
		 }	    		
        }
		
	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>