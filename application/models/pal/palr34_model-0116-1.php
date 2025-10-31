<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class palr34_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	
	//印明細表	
	function printfd()          
        {
		  $seq3=substr($this->input->post('dateo'),0,4);
	   	  $seq4=substr($this->input->post('datec'),0,4).substr($this->input->post('datec'),5,2).substr(rtrim($this->input->post('datec')),8,2);
	      $ret['qry_date'] = $this->input->post('dateo');
		  
		  $sql = "SELECT CONCAT(d.mv206,d.mv205) as mkj001,CONCAT(b.mk002,c.mj002) as mkj002
				,b.mk001,b.mk002,b.mk004,c.mj001,c.mj002,a.yh046
				,SUM(a.yh051-a.yh034) as yh51a,SUM(a.yh034) as yh034,SUM(a.yh051) as yh051
				,SUM(a.yh053) as yh053,SUM(a.yh054) as yh054,SUM(a.yh056) as yh056
				,sum(a.yh057) as yh057
				FROM palyh as a 
				LEFT JOIN cmsmv as d on d.mv001 = a.yh002 
				RIGHT JOIN palmk as b on d.mv206 = b.mk001 
				RIGHT JOIN palmj as c on d.mv205 = c.mj001 
					WHERE a.yh001='$seq3' GROUP BY  mkj001,mkj002 ORDER BY mk004 ASC , mkj001 ASC";  
		
		  $query = $this->db->query($sql); 
	      $ret['rows'] = $query->result();
		  //echo "<pre>";var_dump($ret['rows']);exit;
		  //  $seq32 = "td005='$seq3'  ";	
	      $sql = "SELECT COUNT(o.mkj001) as count_num from(
					SELECT CONCAT(b.mk001,c.mj001) as mkj001
					FROM palyh as a 
					LEFT JOIN cmsmv as d on d.mv001 = a.yh002 
					RIGHT JOIN palmk as b on d.mv206 = b.mk001 
					RIGHT JOIN palmj as c on d.mv205 = c.mj001 
					WHERE a.yh001='$seq3' GROUP BY mkj001) as o";  
		  $query = $this->db->query($sql); 
	      $num = $query->result();
		  $ret['num_rows'] = $num[0]->count_num;
	      
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS tg001disp, d.me002 AS tg004disp, e.mb002 AS tg010disp, f.mv002 AS tg012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mv001, b.mv002, b.mv003, b.mv004, b.mv005,
		  b.mv006, b.mv007, b.mv011, b.mv009, b.mv017, b.mv018, b.mv012');
		 
        $this->db->from('coptg as a');	
        $this->db->join('copth as b', 'a.tg001 = b.mv001  and a.tg002=b.mv002 ','left');		
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.tg004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.tg010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.tg012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.tg001', $this->uri->segment(4)); 
	    $this->db->where('a.tg002', $this->uri->segment(5)); 
		$this->db->order_by('tg001 , tg002 ,b.mv003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('mv001', $this->uri->segment(4));
		$this->db->where('mv002', $this->uri->segment(5));
	    $query = $this->db->get('copth');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆 A4
	function printfc()   
      {           
          $this->db->select('a.* ,c.mq002 AS tg001disp, d.mb002 AS tg010disp,e.mf002 AS tg011disp, f.mv002 AS tg006disp,g.na003 AS tg047disp,
		  ,h.ma002 AS tg004disp,h.ma006 as tg004disp1,h.ma008 as tg004disp2,h.ma005 as tg004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mv001, b.mv002, b.mv003, b.mv004, b.mv005,
		  b.mv006, b.mv007, b.mv008, b.mv009, b.mv010, b.mv011, b.mv012,b.mv013, b.mv014,b.mv016,b.mv017,b.mv018,b.mv019,b.mv031,i.mc002 as mv007disp,j.me002 as tg005disp');
		 
        $this->db->from('coptg as a');	
        $this->db->join('copth as b', 'a.tg001 = b.mv001  and a.tg002=b.mv002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tg010 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tg011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tg006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tg047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tg004 = h.ma001 ','left');  //產品代號
		$this->db->join('cmsmc as i', 'b.mv007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tg005 = j.me001 ','left');   //部門
		$this->db->where('a.tg001', $this->input->post('tg001o')); 
	    $this->db->where('a.tg002', $this->input->post('tg002o')); 
		$this->db->order_by('tg001 , tg002 ,b.mv003');
		
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
		  ,h.ma002 AS tg004disp,h.ma006 as tg004disp1,h.ma008 as tg004disp2,h.ma005 as tg004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mv001, b.mv002, b.mv003, b.mv004, b.mv005,
		  b.mv006, b.mv007, b.mv008, b.mv009, b.mv010, b.mv011, b.mv012,b.mv013, b.mv014,b.mv016,b.mv017,b.mv018,b.mv019,b.mv031,i.mc002 as mv007disp,j.me002 as tg005disp');
		 
        $this->db->from('coptg as a');	
        $this->db->join('copth as b', 'a.tg001 = b.mv001  and a.tg002=b.mv002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tg010 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tg011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tg006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tg047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tg004 = h.ma001 ','left');  //產品代號
		$this->db->join('cmsmc as i', 'b.mv007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tg005 = j.me001 ','left');   //部門
		$this->db->where('a.tg001', $this->uri->segment(4)); 
	    $this->db->where('a.tg002', $this->uri->segment(5)); 
		$this->db->order_by('tg001 , tg002 ,b.mv003');
		
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