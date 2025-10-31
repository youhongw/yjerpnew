<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Copr06_model extends CI_Model {
	
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
		  
		  $seq5=$this->input->post('cmsq09a3');  //業務員
	      $seq6=$this->input->post('cmsq09a31');
		  
		  $seq7=$this->input->post('th004');   //品號
	      $seq8=$this->input->post('th0041');
	
		   $this->db->where('tg004 >', '0');
		   $this->db->delete('copth1');
		  //客戶代號,客戶名稱,品號,品名,規格,單位,數量,金額, 成本金額, 毛利
	     $sql9 = " SELECT a.tg004,c.ma002 as tg004disp,sum(b.th008) as th008,sum(b.th013) as th013
		  FROM coptg as a
		  LEFT JOIN copth as b ON a.tg001=b.th001 and a.tg002=b.th002 
		  LEFT JOIN copma as c ON a.tg004=c.ma001 
		  LEFT JOIN invmb as d ON b.th004=d.mb001
		  WHERE th008>0 and  tg004 >= '$seq1'  AND tg004 <= '$seq2' AND tg042 >= '$seq3'  AND tg042 <= '$seq4'  AND tg006 >= '$seq5'  AND tg006 <= '$seq6' AND th004 >= '$seq7'  AND th004 <= '$seq8'
          GROUP BY c.ma002,a.tg004
		  UNION
          SELECT a.ti004 as tg004,c.ma002 as tg004disp,sum(b.tj007)*-1 as th008,sum(b.tj012)*-1 as th013		  
           FROM copti as a
		  LEFT JOIN coptj as b ON a.ti001=b.tj001 and a.ti002=b.tj002 
		  LEFT JOIN copma as c ON a.ti004=c.ma001 
		  LEFT JOIN invmb as d ON b.tj004=d.mb001
		  WHERE tj007>0 and ti004 >= '$seq1'  AND ti004 <= '$seq2' AND ti034 >= '$seq3'  AND ti034 <= '$seq4'  AND ti006 >= '$seq5'  AND ti006 <= '$seq6' AND tj004 >= '$seq7'  AND tj004 <= '$seq8'
		  GROUP BY c.ma002,a.ti004
		  ORDER BY th013 desc
		  "; 
		 //  $result = mysql_query($sql9) or die_content("查詢資料失敗".mysql_error());
         //  while($row=mysql_fetch_assoc($result)){
			 $query = $this->db->query($sql9) ;
		     foreach ($query->result() as $row) {
        foreach($row as $i=>$v){
            $$i=$v;
        }
		$data1 = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'tg004' => $tg004, 
		         'tg004disp' => $tg004disp,
			     'th008' => $th008,
				 'th013' => $th013
                );	
		  if ($tg004>'0') {
			   $this->db->insert('copth1', $data1);		   
			   }
	}
		   $sql = " SELECT tg004,tg004disp,sum(th008) as th008,sum(th013) as th013 FROM copth1
		             GROUP BY  tg004,tg004disp  ORDER BY th013 desc "; 
		  
		  
		  
          $query = $this->db->query($sql); 
	      $ret['rows'] = $query->result();  
          $seq32 = "tg004 >= '$seq1'  AND tg004 <= '$seq2' AND tg042 >= '$seq3'  AND tg042 <= '$seq4'  AND tg006 >= '$seq5'  AND tg006 <= '$seq6' ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('coptg')
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