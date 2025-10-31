<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actr09_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
	//	$sql = " SELECT a.mba001,a.mba002,c.mba002 as mba002disp,a.mba003,b.mb002,b.mb003,b.mb004,a.mba007,a.mba008,
	
	//印明細表	
	function printfd()          
        {
			
	        $vyy=substr($this->input->post('bdate'),0,4);
			$vmm=substr($this->input->post('bdate'),5,2);
			$bdate=$this->input->post('bdate');
			$edate=$this->input->post('edate');
			$vbdate=substr($this->input->post('bdate'),0,4).substr($this->input->post('bdate'),5,2).'01';
		//	$vedate=substr($this->input->post('edate'),0,4).substr($this->input->post('edate'),5,2).substr($this->input->post('edate'),6,2);
			//下月  dmm
			$vdmm=substr($this->input->post('edate'),5,2);
			 $bvdmm = (int) $vdmm+1;
			 $bvdmm =  (string)$bvdmm;
			 if (strlen($bvdmm)==1) {$bvdmm='0'.$bvdmm;}
			 
		//	$vedate=substr($this->input->post('edate'),0,4).$bvdmm.substr($this->input->post('edate'),6,2);
			$vedate=substr($this->input->post('edate'),0,4).substr($this->input->post('edate'),5,2).substr($this->input->post('edate'),8,2);
			//上個月餘額  月 bvmm 改 $vmm $bvmm
			 $bvmm = (int) $vmm-1;
			 $bvmm =  (string)$bvmm;
			 if (strlen($bvmm)==1) {$bvmm='0'.$bvmm;}
			
			$bactno=$this->input->post('bactno');
		    $eactno=$this->input->post('eactno');
			
		    $query = $this->db->query("SELECT mba003 as tb005, mba004 as tb005disp, '' as ta003,'' as tb001,'' as tb002,'' as tb003, '' as tb010,
                   0 as tb0071, 0 as tb0072,mba017, mba005 as tb004,ma007 FROM actmba as a,actma as b
                    WHERE  mba001='$vyy' and mba002='$bvmm' and mba003='$bactno'  and mba003=ma001     
                   UNION
                   SELECT  tb005, c.ma003 as tb005disp, ta003, tb001,tb002,tb003,tb010,
                  tb007 as tb0071,tb007 as tb0072,tb007 as mba017, tb004,ma007 FROM actta as a,acttb as b,actma as c
                  WHERE  ta001=tb001 and ta002=tb002 and tb005=ma001 and ta003>=concat('$vyy','$vmm','01') and ta003<='$vedate' and tb005='$bactno' 
				    ORDER BY  tb005,ta003,tb002,tb003 ");  
		
		//$query = $this->db->get($sql);
		
       $ret['rows'] = $query->result();  
        //  $seq32 = "ta003 >= '$vbdate'  AND ta003 <= '$vedate'  ";	
	      $query = $this->db->select('ta003,COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('actta')
		              ->where('ta003 >=',$vbdate)
					  ->where('ta003 <=',$vedate);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
	//excel	
	function excelnewf()          
        {
			
	        $vyy=substr($this->input->post('bdate'),0,4);
			$vmm=substr($this->input->post('bdate'),5,2);
			$bdate=$this->input->post('bdate');
			$edate=$this->input->post('edate');
			$vbdate=substr($this->input->post('bdate'),0,4).substr($this->input->post('bdate'),5,2).'01';
		
			//下月  dmm
			$vdmm=substr($this->input->post('edate'),5,2);
			 $bvdmm = (int) $vdmm+1;
			 $bvdmm =  (string)$bvdmm;
			 if (strlen($bvdmm)==1) {$bvdmm='0'.$bvdmm;}
			$vedate=substr($this->input->post('edate'),0,4).substr($this->input->post('edate'),5,2).substr($this->input->post('edate'),8,2);
			//上個月餘額  月 bvmm 改 $vmm $bvmm
			 $bvmm = (int) $vmm-1;
			 $bvmm =  (string)$bvmm;
			 if (strlen($bvmm)==1) {$bvmm='0'.$bvmm;}
			
			$bactno=$this->input->post('bactno');
		    $eactno=$this->input->post('eactno');
			
		    $query = $this->db->query("SELECT mba003 as tb005, mba004 as tb005disp, '' as ta003,'' as tb001,'' as tb002,'' as tb003, '' as tb010,
                   0 as tb0071, 0 as tb0072,mba017, mba005 as tb004,ma007 FROM actmba as a,actma as b
                    WHERE  mba001='$vyy' and mba002='$bvmm' and mba003='$bactno'  and mba003=ma001     
                   UNION
                   SELECT  tb005, c.ma003 as tb005disp, ta003, tb001,tb002,tb003,tb010,
                  tb007 as tb0071,tb007 as tb0072,tb007 as mba017, tb004,ma007 FROM actta as a,acttb as b,actma as c
                  WHERE  ta001=tb001 and ta002=tb002 and tb005=ma001 and ta003>=concat('$vyy','$vmm','01') and ta003<='$vedate' and tb005='$bactno' 
				    ORDER BY  tb005,ta003,tb002,tb003 ");  
		
		//$query = $this->db->get($sql);
		
       $results = $query->result();  
	   //列印
	     //刪除列印檔案 acttbp
		   $this->db->where('tb001 >=', '0');
		   $this->db->delete('acttbp');
		   //tb007 傳票金額 科目設定ma007 1借,-1貸  傳票 $vtb072 貸方金額
		  $mvtb071=0;$mvtb072=0;$pvmba017=0;$pvmba017a=0; 
         $vmba017=0;$vvtb071=0;$vvtb072=0;$kvtb004=0; $vvtb004=0;
         $vth003='1010';		//流水號重新排序		 
	    foreach($results as $row ) : 
	      
		    $mvtb004=$row->tb004; 
		  if ($row->tb004==1) {$vtb071=$row->tb0071;$vtb072=0;$vvtb004=1;} else {$vtb072=$row->tb0072;$vtb071=0;$vvtb004=-1;} 
			
		  if ($vvtb004==$mvtb004 and $row->tb004==1 and $row->ma007==1) {$vmba017=$vmba017+($row->mba017*$row->tb004);}  
		  if ($vvtb004!=$mvtb004 and $row->tb004==1 and $row->ma007==1) {$vmba017=$vmba017-($row->mba017*$row->tb004*-1);} 
		
		  if ($vvtb004==$mvtb004 and $row->tb004==1 and $row->ma007==-1) {$vmba017=$vmba017-($row->mba017*$row->tb004);}  
		  if ($vvtb004!=$mvtb004 and $row->tb004==1 and $row->ma007==-1) {$vmba017=$vmba017+($row->mba017*$row->tb004*-1);} 
		
		  if ($vvtb004==$mvtb004 and $row->tb004==-1 and $row->ma007==1) {$vmba017=$vmba017-($row->mba017);}  
		      
		  if ($vvtb004!=$mvtb004 and $row->tb004==-1 and $row->ma007==1)  {$vmba017=$vmba017+($row->mba017);} 
		        
		  if ($vvtb004==$mvtb004 and $row->tb004==-1 and $row->ma007==-1) {$vmba017=$vmba017+($row->mba017);}  
		  if ($vvtb004!=$mvtb004 and $row->tb004==-1 and $row->ma007==-1)  {$vmba017=$vmba017-($row->mba017);} 
		
		 // if ( $kvtb004==0 )  {$vmba017=($row->mba017)*1;}  
		 // if ( $kvtb004==0 and ( $row->tb004==-1 and $row->ma007==1))  {$vmba017=($row->mba017)*-1;}  
		
		  if ($vmba017>=0 and $row->ma007==1) {$vtb004='借餘';$mvtb004=1;}  
		
          if ($vmba017>=0 and $row->ma007==-1) {$vtb004='貸餘';$mvtb004=1;}  
		
		  if ($vmba017<0 and $row->ma007==1) {$vtb004='貸餘';$mvtb004=-1;} 
		
		 if ($vmba017<0 and $row->ma007==-1) {$vtb004='借餘';$mvtb004=-1;} 
		
		 $vvtb071=$vvtb071+$vtb071; 
		 $vvtb072=$vvtb072+$vtb072; 
		
		  if ($vtb071==0) {$vtb071=0;} else {$vtb071=number_format($vtb071, 2, '.' ,'');} 
		  if ($vtb072==0) {$vtb072=0;} else {$vtb072=number_format($vtb072, 2, '.' ,'');}  
		  if ($vmba017==0) {$pvmba017=0;} else {$pvmba017=number_format($vmba017, 2, '.' ,'');}  
	      $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => '',
		          'modi_date' => '',
		          'flag' => 0,
				  'tb001' => $vth003,
                  'tb002' => $row->tb005,
		          'tb003' => $row->tb005disp,
				  'tb004' => $row->ta003,
		          'tb005' => $row->tb001.'-'.$row->tb002.'-'.$row->tb003,
		          'tb006' => $row->tb010,		        
                  'tb007' => $vtb071,
				  'tb008' => $vtb072,
				  'tb009' => $pvmba017,
				  'tb010' => $vtb004
                      );
			$this->db->insert('acttbp', $data);
			$mth003 = (int) $vth003+10;
			$vth003 =  (string)$mth003;
			 $mvtb071=$mvtb071+round($vtb071);$mvtb072=$mvtb072+round($vtb072);
			 $pvmba017a=$pvmba017a+$pvmba017;
	     endforeach;
		 //列印明細
		 $sql = "SELECT tb002,tb003,tb004,tb005,tb006,tb007,tb008,tb009,tb010 FROM acttbp order by tb001 "; 
	      $query = $this->db->query($sql);
	     return $query->result_array();
        }
	//轉excel檔	 
	function excelnewffffffff()  {	  
	     $vyy=substr($this->input->post('bdate'),0,4);
			$vmm=substr($this->input->post('bdate'),5,2);
			$bdate=$this->input->post('bdate');
			$edate=$this->input->post('edate');
		 $vedate=substr($this->input->post('edate'),0,4).substr($this->input->post('edate'),5,2).substr($this->input->post('edate'),8,2);
			//上個月餘額  月 bvmm 改 $vmm $bvmm
			 $bvmm = (int) $vmm-1;
			 $bvmm =  (string)$bvmm;
			 if (strlen($bvmm)==1) {$bvmm='0'.$bvmm;}
		 $bactno=$this->input->post('bactno');
		 $eactno=$this->input->post('eactno');
	     $sql = "SELECT mba003 as tb005, mba004 as tb005disp, '' as ta003,'' as tb001,'' as tb002,'' as tb003, '' as tb010,
                   0 as tb0071, 0 as tb0072,mba017, mba005 as tb004 FROM actmba as a,actma as b
                    WHERE  mba001='$vyy' and mba002='$bvmm' and mba003='$bactno'  and mba003=ma001     
                   UNION
                   SELECT  tb005, c.ma003 as tb005disp, ta003, tb001,tb002,tb003,tb010,
                  tb007 as tb0071,tb007 as tb0072,tb007 as mba017, tb004 FROM actta as a,acttb as b,actma as c
                  WHERE  ta001=tb001 and ta002=tb002 and tb005=ma001 and ta003>=concat('$vyy','$vmm','01') and ta003<='$vedate' and tb005='$bactno' 
				    ORDER BY  tb005,ta003,tb002,tb003 "; 
         $query = $this->db->query($sql);
	     return $query->result_array();
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