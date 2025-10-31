<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bomr06_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
		//  $base_bom_list[0]['bom_base'] = $base_item['$md002'];
		   $md002='1000';
		   $base_bom_list[0]['bom_base'] = $md002;
	       $level_count = 0;
	       $base_bom_list = array();
		   $row_temp = array();
		   $base_item=array();  //md001
		   $temp_list=array();  //md001
		   $tail_list=array();
        }
	
	function check_have_bom($temp_item){
		if(!$temp_item['md003'])
			return 0;
		$sql = "select md003 from bommd where md003 = '".$temp_item['md003']."'";
		//$result = mysql_query($sql);
		$result = $this->db->query($sql) ;
		//if($row = mysql_fetch_array($result))
		if(!$result->result_array())
			return 1;
		else
			return 0;
	}
	
	function get_bom_list_out($temp_list){
		$level_count = 0;
		//$temp_list_item = $this->get_item_data($temp_list);
		$sql = "select a.md001,a.md002,a.md003,a.md004,a.md005,a.md006,a.md008,a.md016,b.mb002,b.mb003,b.mb025 from bommd as a,invmb as b  where a.md003=b.mb001 and a.md003 = '".$temp_list."' order by a.md001,a.md002 ";
		//$result = mysql_query($sql);
		$result = $this->db->query($sql) ;
		//$row_temp = mysql_fetch_array($result);
		foreach ($result->result_array() as $row_temp){}
		$temp_list_item = $row_temp;
		$temp_item = $this->get_item_data($temp_list);
		$temp_list_item['mb001'] = $temp_item['mb001'];
		$temp_list_item['mb002'] = $temp_item['mb002'];
		$temp_list_item['mb003'] = $temp_item['mb003'];
		$temp_list_item['mb004'] = $temp_item['mb004'];
		$temp_list_item['mb025'] = $temp_item['mb025'];
		$temp_list_item['level'] = "0";
		$base_bom_list = $this->get_bom_list($temp_list_item);
		
		return $base_bom_list;
	}
	
	function get_bom_list($temp_list)          //get_bom_list  遞廻$m_count,$base_bom_list,$row_temp,$vmd003
    {
		//echo "<pre>"; var_dump($temp_list);exit;
	    global $level_count,$row_temp;
		$sql = "select a.md001,a.md002,a.md003,a.md004,a.md005,a.md006,a.md008,a.md016,b.mb002,b.mb003,b.mb025 from bommd as a,invmb as b  where a.md003=b.mb001 and a.md003 = '".$temp_list['mb001']."' order by a.md001,a.md002 ";
		//$result = mysql_query($sql);
		$result = $this->db->query($sql) ;
		$count_temp = 0;
		
	//	$temp_list = array();
		$level_count++;                   //階層
		
		//while($row_temp = mysql_fetch_array($result)){
			foreach ($result->result_array() as $row_temp){
			$temp_list["bom_list"][$count_temp] = $this->get_item_data($row_temp['md001']);
			$temp_list["bom_list"][$count_temp]["md002"] = $row_temp['md002'];
			$temp_list["bom_list"][$count_temp]["md003"] = $row_temp['md003'];
			$temp_list["bom_list"][$count_temp]["md004"] = $row_temp['md004'];
			$temp_list["bom_list"][$count_temp]["md005"] = $row_temp['md005'];
			$temp_list["bom_list"][$count_temp]["md006"] = $row_temp['md006'];
			$temp_list["bom_list"][$count_temp]["md008"] = $row_temp['md008'];
			$temp_list["bom_list"][$count_temp]["md016"] = $row_temp['md016'];
			$temp_list["bom_list"][$count_temp]["mb025"] = $row_temp['mb025'];
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
		$sql = "select mb001,mb002,mb003,mb004,mb025 from invmb where mb001 = '$temp_it_id'";
		//$result = mysql_query($sql);
		$result = $this->db->query($sql);
		//$temp_row = mysql_fetch_array($result);
		
		//echo "<pre>";var_dump($temp_row);exit;
		// $temp_row['md001'] = $temp_row['mb001'];
		foreach ($result->result_array() as $temp_row)
          {
			  $temp_row['md001'] = $temp_row['mb001'];
		  }
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