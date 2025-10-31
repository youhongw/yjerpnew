<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bomr07_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
	//	$sql = " SELECT a.mc001,a.mc002,c.mc002 as mc002disp,a.mc003,b.mb002,b.mb003,b.mb004,a.mc007,a.mc008,
	
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('invq02a');    //品號
	      $seq2=$this->input->post('invq02a1');
		
		//  $seq3=$this->input->post('cmsq03a');   //庫別
	    //  $seq4=$this->input->post('cmsq03a1');
		  
		//  $seq5=$this->input->post('mc003');  //儲位
	   //   $seq6=$this->input->post('mc0031');
		/*$this->db->select('a.*,c.mb002 as mc001disp,c.mb003 as mc001disp1,c.mb025 as mc001disp2,
			b.md002,b.md003,d.mb002 as md003disp,d.mb003 as md003disp1,d.mb025 as md003disp2,
			b.md004,b.md010,b.md017,b.md006,b.md007,b.md008,b.md014 '); 
		 */
		$this->db->select('a.mc001,a.mc002,a.mc003,a.mc004,b.md001,b.md002,b.md003,b.md004,
		b.md005,b.md006,c.mb002 as c_mb002,c.mb003 as c_mb003,c.mb025 as c_mb025,d.mb001,
		d.mb002,d.mb003,d.mb025,d.mb057,d.mb058,d.mb059,d.mb060');
		
        $this->db->from('bommc as a');
        $this->db->join('bommd as b', 'a.mc001 = b.md001 ','left');	//bom
		$this->db->join('invmb as c', 'a.mc001 = c.mb001 ','left');	//品號1
		$this->db->join('invmb as d', 'b.md003 = d.mb001 ','left');	//品號2
		
	/*	$this->db->join('cmsmc as c', 'a.mc002 = c.mc001 ','left');   //庫別
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tc007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tc008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tc006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tc014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tc004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.td007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tc005 = j.me001 ','left');   //部門 */
		$this->db->where('a.mc001 ', $seq1); 
	   // $this->db->where('a.mc001 <=', $seq2); 
		//$this->db->group_by('b.md003');
		$this->db->order_by('b.md001,b.md002');
		
		$query = $this->db->get();
		$ret = $query->result();
		$head_col = array('mc001','c_mb002','c_mb003','c_mb025','mc002','mc003','mc004');	$ret_head=array();
		$ret_head=array();
		foreach ($ret as  $value )
          {
		foreach($head_col as $val){
			$ret_head[$val] = $value->$val;	
		  }}
		  
		//foreach($head_col as $val){
		//	$ret_head[$val] = $ret[0]->$val;
		//}
		$body_col = array('mb001','mb002','mb003','md002','md004','md005','md006','mb025','mb057',
		'mb058','mb059','mb060');	$ret_body=array();
		$num_count = 0;
		foreach($ret as $key => $value){
			foreach($body_col as $val){
				$ret_body[$val] = $value->$val;
			}
			$ret_head['bom_list'][$key] = $ret_body;$num_count++;
		}
		$ret['rows'] = $ret_head;
		/*$seq32 = "md001 >= '$seq1'  AND md001 <= '$seq1'    ";	
		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
					->from('bommd')
					->where($seq32);
		$num = $query->get()->result();	*/	
		$ret['num_rows'] = $num_count;		
		return $ret;
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