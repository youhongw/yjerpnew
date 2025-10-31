<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actr12_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
	//	$sql = " SELECT a.mba001,a.mba002,c.mba002 as mba002disp,a.mba003,b.mb002,b.mb003,b.mb004,a.mba007,a.mba008,
	
	//計算切傳票資料
	function batchaf()           
        {
			$byymmdd=substr($this->input->post('bdate'),0,4).substr($this->input->post('bdate'),5,2).substr($this->input->post('bdate'),8,2);
			$eyymmdd=substr($this->input->post('edate'),0,4).substr($this->input->post('edate'),5,2).substr($this->input->post('edate'),8,2);
				 
		          //刪除計算月份
			         $this->db->where('mb1002 >=', $byymmdd);
					 $this->db->where('mb1002 <=', $eyymmdd);
		             $this->db->delete('actmb1'); 
				 //年月科目insert 
		  $sql03 ="insert into actmb1 (mb1001,mb1002,mb1003)
select distinct tb005,ta003,ma003 
 from actta as a left join acttb as b on a.ta001=b.tb001 and a.ta002=b.tb002
                 left join actma as c on b.tb005=ma001
where ta003 >='$byymmdd' and  ta003 <='$eyymmdd' and tb005>'0' ";
          $this->db->query($sql03);  	 
			//年月日1借update 科目編號tb005,借貸,年度,期別,幣別, 本幣金額,原幣金額, 筆數 ok
		  $sql04 ="update actmb1 as a ,
		 (select tb005,ta003,  tb004,sum(tb015) as vtb015, 
sum(tb007) as vtb007,count(tb004) as vcount from actta as a left join acttb as b on a.ta001=b.tb001 and a.ta002=b.tb002
where ta003 >='$byymmdd' and  ta003 <='$eyymmdd' and tb004=1
group by tb005,ta003,tb004) as c set a.mb1009=c.vtb015,a.mb1004=vtb007,a.mb1006=c.vcount
where a.mb1001=c.tb005 and a.mb1002=c.ta003  ";
           $this->db->query($sql04);
			//年月日-1貸update 科目編號tb005,借貸,年度,期別, 本幣金額,原幣金額, 筆數 ok
		  $sql05 ="update actmb1 as a ,
		 (select tb005,ta003,  tb004,sum(tb015) as vtb015, 
sum(tb007) as vtb007,count(tb004) as vcount from actta as a left join acttb as b on a.ta001=b.tb001 and a.ta002=b.tb002
where ta003 >='$byymmdd' and  ta003 <='$eyymmdd' and tb004=-1
group by tb005,ta003,tb004) as c set a.mb1010=c.vtb015,a.mb1005=vtb007,a.mb1007=c.vcount
where a.mb1001=c.tb005 and a.mb1002=c.ta003  ";
           $this->db->query($sql05); 		 
		  return true;
		 	
    } 
	//印明細表	
	function printfd()          
        {
			
			$byymmdd=substr($this->input->post('bdate'),0,4).substr($this->input->post('bdate'),5,2).substr($this->input->post('bdate'),8,2);
			$eyymmdd=substr($this->input->post('edate'),0,4).substr($this->input->post('edate'),5,2).substr($this->input->post('edate'),8,2);
						
		   $this->db->select('a.*,b.ma003 '); 
		 
        $this->db->from('actmb1 as a');
		$this->db->join('actma as b', 'a.mb1003 = b.ma001 ','left');
		$this->db->where('a.mb1002 >=',$byymmdd ); 
	    $this->db->where('a.mb1002 <=',$eyymmdd );
		$this->db->order_by('a.mb1002,a.mb1001');
		
		$query = $this->db->get();
		
       $ret['rows'] = $query->result();  
          $seq32 = "mb1002 >= '$byymmdd'  AND mb1002 <= '$eyymmdd'    ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('actmb1')
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
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th016,b.th017,b.th018,b.th019,b.th031,i.mba002 as th007disp,j.me002 as tg005disp');
		 
        $this->db->from('coptg as a');	
        $this->db->join('copth as b', 'a.tg001 = b.th001  and a.tg002=b.th002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tg010 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tg011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tg006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tg047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tg004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mba001 ','left');   //庫別
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
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th016,b.th017,b.th018,b.th019,b.th031,i.mba002 as th007disp,j.me002 as tg005disp');
		 
        $this->db->from('coptg as a');	
        $this->db->join('copth as b', 'a.tg001 = b.th001  and a.tg002=b.th002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tg010 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tg011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tg006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tg047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tg004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mba001 ','left');   //庫別
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