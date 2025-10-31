<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acrr03_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('copq01a');    //客代
	      $seq2=$this->input->post('copq01a1');
		//結帳日, 顯示日
		  $seq3=substr($this->input->post('dateo'),0,4).substr($this->input->post('dateo'),5,2).substr(rtrim($this->input->post('dateo')),8,2);
	      $seq4=substr($this->input->post('datec'),0,4).substr($this->input->post('datec'),5,2).substr(rtrim($this->input->post('datec')),8,2);
		  
		  $seq5=substr($this->input->post('dateo1'),0,4).substr($this->input->post('dateo1'),5,2).substr(rtrim($this->input->post('dateo1')),8,2);
	      $seq6=substr($this->input->post('datec1'),0,4).substr($this->input->post('datec1'),5,2).substr(rtrim($this->input->post('datec1')),8,2);
		  $seq7=$this->input->post('cmsq06a');   //幣別 
	   //   $seq8=$this->input->post('copq03a221');
		//  $seq9=$this->input->post('tc002');   //訂單單號 
	   //   $seq10=$this->input->post('tc0021');
		//  $seq11=$this->input->post('td016');  //結案碼
		  
		//  $this->db->select('a.* ,c.mq002 AS ta001disp, d.mb002 AS ta006disp,e.mf002 AS ta009disp, g.na003 AS ta043disp,
		//  ,h.ma002 AS ta004disp,i.ml002 as ta005disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		//  b.tb006, b.tb007, b.tb008, b.tb009, b.tb010, b.tb011, b.tb012,b.tb013, b.tb017,b.tb018, b.tb019, b.tb020,b.tb021,j.ma003 as tb013disp,k.me002 as tb021disp ');
		//銷貨
          $this->db->select('a.ta004,h.ma003 as ta004disp,h.ma015 as tb021,k.me002 as tb021disp,h.ma004,h.ma005,h.ma006,h.ma008,ma027,
		                  a.ta015,b.tb004,m.tg003,m.tg002,l.th005,l.th006,th008,l.th012,l.th013,m.tg044,m.tg017,m.tg042
		                         ');		
		  
        $this->db->from('acrta as a');	
        $this->db->join('acrtb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');
		$this->db->join('cmsmf as e', 'a.ta009 = e.mf001 ','left');   //幣別
		$this->db->join('copma as h', 'a.ta004 = h.ma001 ','left');   //客戶代號
		$this->db->join('cmsml as i', 'a.ta005 = i.ml001 ','left');   //收款業務員
		$this->db->join('cmsme as k', 'h.ma015 = k.me001 ','left');   //部門
	    $this->db->join('copth as l', 'b.tb005 = l.th001  and b.tb006=l.th002 and b.tb006>"" ','left'); //銷貨明細	
		$this->db->join('coptg as m', 'b.tb005 = m.tg001  and b.tb006=m.tg002 and m.tg001=l.th001 and m.tg002=l.th002 ','left'); //銷貨單頭	
		$this->db->where('a.ta004 >=', $seq1); 
	    $this->db->where('a.ta004 <=', $seq2); 
		$this->db->where('a.ta003 >=', $seq3); 
	    $this->db->where('a.ta003 <=', $seq4); 
        $this->db->where('a.ta009', $seq7);
		 $this->db->where('b.tb004', '1');
      //  if ($seq11 != "A")	{$this->db->where('upper(b.td016)', $seq11); }	
		$this->db->order_by('ta004 , ta003, tb004 ');
		
		$query1 = $this->db->get()->result();
		//銷退
		
        $this->db->select('a.ta004,h.ma003 as ta004disp,h.ma015 as tb021,k.me002 as tb021disp,h.ma004,h.ma005,h.ma006,h.ma008,ma027,
		                  a.ta015,b.tb004,m.ti003 as tg003,m.ti002 as tg002 ,l.tj005 as th005,l.tj006 as th006,(l.tj007 * -1) as th008,l.tj011 as th012,(l.tj012 * -1) as th013,m.ti036 as tg044,m.ti013 as tg017,m.ti034 as tg042
		                         ');		
		  
        $this->db->from('acrta as a');	
        $this->db->join('acrtb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');
		$this->db->join('cmsmf as e', 'a.ta009 = e.mf001 ','left');   //幣別
		$this->db->join('copma as h', 'a.ta004 = h.ma001 ','left');   //客戶代號
		$this->db->join('cmsml as i', 'a.ta005 = i.ml001 ','left');   //收款業務員
		$this->db->join('cmsme as k', 'h.ma015 = k.me001 ','left');   //部門
	    $this->db->join('coptj as l', 'b.tb005 = l.tj001  and b.tb006=l.tj002 and b.tb006>"" ','left'); //銷退明細	
		$this->db->join('copti as m', 'b.tb005 = m.ti001  and b.tb006=m.ti002 and m.ti001=l.tj001 and m.ti002=l.tj002 ','left'); //銷退單頭	
		$this->db->where('a.ta004 >=', $seq1); 
	    $this->db->where('a.ta004 <=', $seq2); 
		$this->db->where('a.ta003 >=', $seq3); 
	    $this->db->where('a.ta003 <=', $seq4); 
        $this->db->where('a.ta009', $seq7);
         $this->db->where('b.tb004', '2');   //銷退
		$this->db->order_by('ta004 , ta003, tb004 ');
		$query2 = $this->db->get()->result();
		
		$query = array_merge($query1, $query2);
	    sort($query);
	//	$query  = mergesort($query);
		
		
	     $ret['rows'] = $query; 
	  //   $ret['rows'] = $query->result();  
          $seq32 = "tg004 >= '$seq1'  AND tg004 <= '$seq2' AND tg003 >= '$seq3'  AND tg003 <= '$seq4'   ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('coptg')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	function mergesort($data) {
	    if(count($data)>1) {
	        $data_middle = round(count($data)/2, 0, PHP_ROUND_HALF_DOWN);
	        $data_part1 = mergesort(array_slice($data, 0, $data_middle));
	        $data_part2 = mergesort(array_slice($data, $data_middle, count($data)));
	        $counter1 = $counter2 = 0;
	        for ($i=0; $i<count($data); $i++) {
	            if($counter1 == count($data_part1)) {
	                $data[$i] = $data_part2[$counter2];
	                ++$counter2;
	            } elseif (($counter2 == count($data_part2)) or ($data_part1[$counter1] < $data_part2[$counter2])) {
	                $data[$i] = $data_part1[$counter1];
	                ++$counter1;
	            } else {
	                $data[$i] = $data_part2[$counter2];
	                ++$counter2;
	            }
	        }
	    }
	    return $data;
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