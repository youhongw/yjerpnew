<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Palr52_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	
	//印明細表	
	function printfd()          
        {
	   //   $seq1=$this->input->post('palq01a');    //客代
	    //  $seq2=$this->input->post('palq01a1');
		
		  $seq3=substr($this->input->post('dateo'),0,4).substr($this->input->post('dateo'),5,2).substr(rtrim($this->input->post('dateo')),8,2);
	   	
		   $this->db->where('te002 =', $seq3);
		   $this->db->delete('palte'); 
		   
	     $query = $this->db->query("SELECT min(te001) as te001disp  FROM palte  WHERE te002 = '$seq3'  "); 
		 
		 foreach ($query->result() as $row)
            {
            $te001disp[]=$row->te001disp;		 
            }
		
			
			$mte001disp=$te001disp[0];
		
			
			$kte003disp=$mte001disp;  //員工代號
			$vte006disp='';
		//	$kte006disp='';$kte001disp='';$kte002disp='';$kte003disp='';$kte004disp='';$kte005disp='';$kte007disp='';$vte006disp='';
			
		    $kte001disp=$mte001disp;   
		
		  //員工代號,刷卡日期,時間 palte
		   $sql9 = " SELECT IFNULL(d.mo003,'0800') as mo003,a.mv004 as te001disp,IFNULL(c.me002,'') as te002disp,a.mv001 as te003disp,a.mv002 as te004disp,a.mv027 as te005disp,IFNULL(b.te003,'') as te006disp,IFNULL(b.te002,$seq3) as te007disp 
		   FROM cmsmv as a
		  LEFT JOIN palte as b ON a.mv001=b.te001 and b.te002 = '$seq3' 
		  LEFT JOIN cmsme as c ON a.mv004=c.me001
		  LEFT JOIN palmo as d ON a.mv027=d.mo001
		  WHERE a.mv022=''  and a.mv026='Y'  
          ORDER BY  b.te002,a.mv001,b.te003 "; 
		  
	 /*   $sql9 = " SELECT b.mv004 as te001disp,c.me002 as te002disp,a.te001 as te003disp,b.mv002 as te004disp,b.mv027 as te005disp,a.te003 as te006disp,a.te002 as te007disp FROM palte as a
		  LEFT JOIN cmsmv as b ON a.te001=b.mv001 
		  LEFT JOIN cmsme as c ON b.mv004=c.me001
		  WHERE a.te002 = '$seq3'
          ORDER BY a.te002,a.te001,a.te003 ";  */
		  
		   $result = mysql_query($sql9) or die_content("查詢資料失敗".mysql_error());
        while($row=mysql_fetch_assoc($result)){
        foreach($row as $i=>$v){
            $$i=$v;
        }
		$vte003disp=$te003disp;  //員工代號 1410,1437
		$vte001disp=$te001disp;
		$vte002disp=$te002disp;
		$vte004disp=$te004disp;
		$vte005disp=$te005disp;
		$vte006disp=$vte006disp.' '.$te006disp;
		$vte007disp=$te007disp;
         
        		 
		
		if ($kte003disp != $vte003disp) {
			if (($mo003<$te006disp) || ($te006disp=='')) {$err1='異常';	} else {$err1='';}
		$data1 = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'te001' => $vte001disp, 
		         'te002' => $vte002disp,
			     'te003' => $vte003disp,
			     'te004' => $vte004disp,
			     'te005' => $vte005disp,
				 'te006' => $err1.$vte006disp,
				 'te007' => $vte007disp
                );	
		   
			 $this->db->insert('palte1', $data1);
              IF ($err1=='') {$vte006disp='';}			 
			   }
			$kte003disp=$vte003disp;
		
	}
		
	   if ($kte003disp == $vte003disp) {
		   if ($mo003<$te006disp) {$err1='異常';} else {$err1='';}
		$data2 = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'te001' => $vte001disp, 
		         'te002' => $vte002disp,
			   //  'te003' => $vte003disp,
			     'te004' => $vte004disp,
			     'te005' => $vte005disp,
				 'te006' => $err1.$vte006disp
			//	 'te007' => $vte007disp
                );	
		    $this->db->where('te003', $vte003disp);
			$this->db->where('te007', $vte007disp);
			$this->db->update('palte1', $data2);$vte006disp='';	   
			   }
	    //    $this->db->insert('palte1', $data1);
		   $sql = " SELECT * FROM palte1 WHERE te007='$seq3'   GROUP BY  te007,te001,te003  ORDER BY te001,te003 ";  
		//   $sql = " SELECT * FROM palte WHERE te002='$seq3'   GROUP BY  te007,te001,te003  ORDER BY te001,te003 ";
		  $query = $this->db->query($sql); 
		  
	      $ret['rows'] = $query->result();  
          $seq32 = "te007 = '$seq3'   ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('palte1')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS tg001disp, d.me002 AS tg004disp, e.mb002 AS tg010disp, f.mv002 AS tg012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.te001, b.te002, b.te003, b.te004, b.te005,
		  b.te006, b.te007, b.te011, b.te009, b.te017, b.te018, b.te012');
		 
        $this->db->from('coptg as a');	
        $this->db->join('copth as b', 'a.tg001 = b.te001  and a.tg002=b.te002 ','left');		
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.tg004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.tg010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.tg012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.tg001', $this->uri->segment(4)); 
	    $this->db->where('a.tg002', $this->uri->segment(5)); 
		$this->db->order_by('tg001 , tg002 ,b.te003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('te001', $this->uri->segment(4));
		$this->db->where('te002', $this->uri->segment(5));
	    $query = $this->db->get('copth');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆 A4
	function printfc()   
      {           
          $this->db->select('a.* ,c.mq002 AS tg001disp, d.mb002 AS tg010disp,e.mf002 AS tg011disp, f.mv002 AS tg006disp,g.na003 AS tg047disp,
		  ,h.ma002 AS tg004disp,h.ma006 as tg004disp1,h.ma008 as tg004disp2,h.ma005 as tg004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.te001, b.te002, b.te003, b.te004, b.te005,
		  b.te006, b.te007, b.te008, b.te009, b.te010, b.te011, b.te012,b.te013, b.te014,b.te016,b.te017,b.te018,b.te019,b.te031,i.mc002 as te007disp,j.me002 as tg005disp');
		 
        $this->db->from('coptg as a');	
        $this->db->join('copth as b', 'a.tg001 = b.te001  and a.tg002=b.te002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tg010 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tg011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tg006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tg047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tg004 = h.ma001 ','left');  //產品代號
		$this->db->join('cmsmc as i', 'b.te007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tg005 = j.me001 ','left');   //部門
		$this->db->where('a.tg001', $this->input->post('tg001o')); 
	    $this->db->where('a.tg002', $this->input->post('tg002o')); 
		$this->db->order_by('tg001 , tg002 ,b.te003');
		
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
		  ,h.ma002 AS tg004disp,h.ma006 as tg004disp1,h.ma008 as tg004disp2,h.ma005 as tg004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.te001, b.te002, b.te003, b.te004, b.te005,
		  b.te006, b.te007, b.te008, b.te009, b.te010, b.te011, b.te012,b.te013, b.te014,b.te016,b.te017,b.te018,b.te019,b.te031,i.mc002 as te007disp,j.me002 as tg005disp');
		 
        $this->db->from('coptg as a');	
        $this->db->join('copth as b', 'a.tg001 = b.te001  and a.tg002=b.te002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tg010 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tg011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tg006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tg047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tg004 = h.ma001 ','left');  //產品代號
		$this->db->join('cmsmc as i', 'b.te007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tg005 = j.me001 ','left');   //部門
		$this->db->where('a.tg001', $this->uri->segment(4)); 
	    $this->db->where('a.tg002', $this->uri->segment(5)); 
		$this->db->order_by('tg001 , tg002 ,b.te003');
		
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