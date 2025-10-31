<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acrr01_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('copq01a');    //客代
	      $seq2=$this->input->post('copq01a1');
		
		  $seq3=substr($this->input->post('dateo'),0,4).substr($this->input->post('dateo'),5,2).substr(rtrim($this->input->post('dateo')),8,2);
	      $seq4=substr($this->input->post('datec'),0,4).substr($this->input->post('datec'),5,2).substr(rtrim($this->input->post('datec')),8,2);
		  
		  $seq5=substr($this->input->post('dateo1'),0,4).substr($this->input->post('dateo1'),5,2).substr(rtrim($this->input->post('dateo1')),8,2);
	      $seq6=substr($this->input->post('datec1'),0,4).substr($this->input->post('datec1'),5,2).substr(rtrim($this->input->post('datec1')),8,2);
		  $seq7=$this->input->post('copq03a22');   //訂單單別 
	      $seq8=$this->input->post('copq03a221');
		  $seq9=$this->input->post('tc002');   //訂單單號 
	      $seq10=$this->input->post('tc0021');
		  $seq11=$this->input->post('td016');  //結案碼
		  
		$this->db->select('a.* ,c.mq002 AS tc001disp, d.mb002 AS tc007disp,e.mf002 AS tc008disp, f.mv002 AS tc006disp,g.na003 AS tc014disp,
		  ,h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td016,b.td020,b.td030,b.td031,i.mc002 as td007disp,j.me002 as tc005disp');
        $this->db->from('coptc as a');	
        $this->db->join('coptd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tc007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tc008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tc006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tc014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tc004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.td007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tc005 = j.me001 ','left');   //部門
		$this->db->where('a.tc004 >=', $seq1); 
	    $this->db->where('a.tc004 <=', $seq2); 
		$this->db->where('a.tc003 >=', $seq3); 
	    $this->db->where('a.tc003 <=', $seq4); 
		$this->db->where('b.td013 >=', $seq5); 
	    $this->db->where('b.td013 <=', $seq6); 
        $this->db->where('b.td001 >=', $seq7); 
	    $this->db->where('b.td001 <=', $seq8); 	
        $this->db->where('b.td002 >=', $seq9); 
	    $this->db->where('b.td002 <=', $seq10); 
        if ($seq11 != "A")	{$this->db->where('upper(b.td016)', $seq11); }	
		$this->db->order_by('tc004 , tc003');
		
		$query = $this->db->get();
		  
		  
	 /*     $sql = " SELECT a.tg001,a.tg002,a.tg003,a.tg004,c.ma002 as tg004disp,b.th001,b.th002,b.th003,b.th004,b.th005,b.th006,b.th007,b.th008,b.th009,
		  b.th011,b.th012,b.th013,b.th016
		  FROM coptg as a
		  LEFT JOIN copth as b ON a.tg001=b.th001 and a.tg002=b.th002 
		  LEFT JOIN copma as c ON a.tg004=c.ma001 
		  WHERE  tg001 >= '$seq1'  AND tg001 <= '$seq2' AND tg002 >= '$seq3'  AND tg002 <= '$seq4'  AND tg004 >= '$seq5'  AND tg004 <= '$seq6'
order by a.tg001,a.tg002,b.th003 "; 
          $query = $this->db->query($sql); */
	      $ret['rows'] = $query->result();  
          $seq32 = "tc004 >= '$seq1'  AND tc004 <= '$seq2' AND tc003 >= '$seq3'  AND tc003 <= '$seq4'   ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('coptc')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
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
          $seq1=$this->input->post('copq01a');    //客代
	      $seq2=$this->input->post('copq01a1');
		
		  $seq3=substr($this->input->post('dateo'),0,4).substr($this->input->post('dateo'),5,2).substr(rtrim($this->input->post('dateo')),8,2);
	      $seq4=substr($this->input->post('datec'),0,4).substr($this->input->post('datec'),5,2).substr(rtrim($this->input->post('datec')),8,2);
		  
		  $seq5=$this->input->post('cmsq06a');   //幣別 
	    //  $this->db->select('a.* '); 
         $this->db->select('a.ta004,h.ma003 as ta004disp,b.tb021,k.me002 as tb021disp,h.ma004,h.ma005,h.ma006,h.ma008,h.ma016,i.ml002 as ma016disp,ma027,
		  sum(a.ta029) as ta029, sum(a.ta030) as ta030 , sum(a.ta031) as ta031,sum(a.ta029)+sum(a.ta030)-sum(a.ta031) as ta031disp  ');
		 
        $this->db->from('acrta as a');	
        $this->db->join('acrtb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');
		$this->db->join('cmsmf as e', 'a.ta009 = e.mf001 ','left');   //幣別
		$this->db->join('copma as h', 'a.ta004 = h.ma001 ','left');   //客戶代號
		$this->db->join('cmsml as i', 'a.ta005 = i.ml001 ','left');   //收款業務員
		$this->db->join('cmsme as k', 'b.tb021 = k.me001 ','left');   //部門
		$this->db->where('a.ta004', $seq1); 
	//    $this->db->where('a.ta004 <=', $seq2); 
		$this->db->where('a.ta003 >=', $seq3); 
	    $this->db->where('a.ta003 <=', $seq4); 
		$this->db->where('a.ta009', $seq5); 
		$this->db->group_by(array("a.ta004", "h.ma003", "b.tb021", "k.me002", "h.ma004", "h.ma006", "h.ma008", "h.ma016", "i.ml002", "h.ma027")); 
		$this->db->order_by('a.ta004');
		
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