<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Palr41_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	
	//印明細表	
	function printfd()          
        {
		  $seq1=$this->input->post('ta001o');
	      $seq2=$this->input->post('ta001c');
		  $seq3=substr($this->input->post('dateo'),0,4).substr($this->input->post('dateo'),5,2);
	   	  $seq4=substr($this->input->post('datec'),0,4).substr($this->input->post('datec'),5,2).substr(rtrim($this->input->post('datec')),8,2);
		  $seq5=$this->input->post('mv202');
		  
		   $sql = " SELECT a.*,b.*,c.mv202,c.mv002,d.me002 FROM paltd as a 
		   LEFT JOIN paltc as b on a.td001=b.tc001 and a.td005=b.tc003
		   LEFT JOIN cmsmv as c on a.td001=c.mv001 
		   LEFT JOIN cmsme as d on c.mv004=d.me001 
		               WHERE td005='$seq3' ";  
			
		  if(@$seq1){
			$sql.=" and td001>='$seq1' ";
		  }
		  if(@$seq2){
			$sql.=" and td001<='$seq2' ";
		  }
		  if(@$seq5){
			  $sql.=" and ( mv202 = '".$seq5[0]."' ";
			  foreach($seq5 as $key => $val){
				  $sql .= " or mv202 = '".$val."'";
			  }
			  $sql.=" ) ";
		  }
		  $sql .= " GROUP BY  td001,td003 ORDER BY c.mv004 asc ,c.mv001 asc";  
		  
		  $query = $this->db->query($sql); 
		  
	      $ret['rows'] = $query->result();  
        //  $seq32 = "td005='$seq3'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('paltd')
		              ->where('td005',$seq3);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }	
	
	//列出類別
	function printcol()
        {
	      $this->db->select('mm001, mm002, mm003');
          $this->db->from('palmm');
	      $this->db->order_by('mm001 ASC, mm002 ASC');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('palmm');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
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