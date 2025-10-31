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
			
		  //科目代號 
		          //刪除計算月份
			         $this->db->where('mb1002 >=', $byymmdd);
					 $this->db->where('mb1002 <=', $eyymmdd);
		             $this->db->delete('actmb1'); 
		  
		  $query = $this->db->query("SELECT min(concat(substring(tb005,1,4),ta003)) as tb005  FROM actta as a, acttb as b 
		  WHERE ta001=tb001 AND ta002=tb002  AND ta003 >= '$byymmdd' AND ta003 <= '$eyymmdd'  AND ta010='Y'  ");         
		foreach ($query->result() as $row)
            {
            $tb005[]=$row->tb005;		 
            }
			$mtb005=$tb005[0];
			
	 $vtb005=$mtb005;       //科目代號  1101
	 $mvtb005=$mtb005;        //科目代號換 借貸時使用單頭
	    
    $vtb005='';           //科目代號
	
	$tb0071=0;$tb0072=0;$tb0151=0;$tb0152=0;$tb0071c=0;$tb0072c=0;
	
	$vdail=0;             //第一次廻圈
	$n=0;
	//		sleep(10);科目編號,借貸,年度,期別,幣別, 本幣金額,原幣金額, 筆數

	$sql="select concat(substring(tb005,1,4),ta003) as tb005no,tb004,ta003 as yymmdd, tb013,substring(tb005,1,4) as tb005,
	             sum(tb007*tb014) as tb007 , sum(tb015) as tb015, count(tb007) as tb007c
	  from `actta` as a,`acttb` as b 
	  where  ta001=tb001 AND ta002=tb002  AND  ta003 >= '$byymmdd' AND ta003 <= '$eyymmdd' AND ta010='Y'
	  group by concat(substring(tb005,1,4),ta003),tb004,ta003, tb013,tb005
	  order by  concat(substring(tb005,1,4),ta003),tb004,ta003, tb013,tb005 ";
	$result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
    while($row=mysql_fetch_assoc($result)){
        foreach($row as $i=>$v){
            $$i=$v;
        }
		  if ($vdail==0) {$vtb005=$tb005no;$vtb004=$tb004;$vtb013=$tb013;$vtb007=$tb007;$vtb015=$tb015;$vtb007c=$tb007c;  }            //第一筆 科目相等 1040306
		//  if ($vdail!=0) {$vtb005=$tb005;$vtb004=$tb004;$vtb013=$tb013;$vtb007=$tb007;$vtb015=$tb015;$vtb007c=$tb007c;  }    				 
	//	if ($vtb005!=$tb005 and $vdail >0 and $tb004==1)  {$tb0071=$tb007;$tb0072=0;$tb0151=$tb015;$tb0152=0;$tb0071c=$tb007c;$tb0072c=0;} else {$tb0072=$tb007;$tb0071=0;$tb0152=$tb015;$tb0151=0;$tb0072c=$tb007c;$tb0071c=0;} 
	 	 
 	//0618	 if ($vtb005==$tb005 and  $vdail==0  and $tb004==1 )   {$tb0071=$tb007;$tb0072=0;$tb0151=$tb015;$tb0152=0;$tb0071c=$tb007c;$tb0072c=0;} else {$tb0072=$tb007;$tb0071=0;$tb0152=$tb015;$tb0151=0;$tb0072c=$tb007c;$tb0071c=0;}   //vtc0021 單號+1 
		 if ( $vdail==0  and $tb004==1 )   {$tb0071=$tb007;$tb0072=0;$tb0151=$tb015;$tb0152=0;$tb0071c=$tb007c;$tb0072c=0;} 
		 if ( $vdail==0  and $tb004!=1 )  {$tb0072=$tb007;$tb0071=0;$tb0152=$tb015;$tb0151=0;$tb0072c=$tb007c;$tb0071c=0;}
		 
		 if ($mvtb005!=$tb005no and  $vdail>0  and $tb004==1 )  {$tb0071=$tb007;$tb0072=0;$tb0151=$tb015;$tb0152=0;$tb0071c=$tb007c;$tb0072c=0;} 
		 if ($mvtb005!=$tb005no and $vdail>0 and $tb004!=1)   {$tb0072=$tb007;$tb0071=0;$tb0152=$tb015;$tb0151=0;$tb0072c=$tb007c;$tb0071c=0;}
		
    	if ($mvtb005==$tb005no and  $vdail>0  and $tb004==1 )   {$tb0071=$tb0071+$tb007;$tb0072=$tb0072+0;$tb0151=$tb0151+$tb015;$tb0152=$tb0152+0;$tb0071c=$tb0071c+$tb007c;$tb0072c=0;} 
		 if ($mvtb005==$tb005no and $vdail>0 and $tb004!=1)     {$tb0072=$tb0072+$tb007;$tb0071=$tb0071+0;$tb0152=$tb0152+$tb015;$tb0151=$tb0151+0;$tb0072c=$tb0072c+$tb007c;$tb0071c=$tb0071c+0;}
		
         	$vtb005=$tb005no;  //科目代號
			$vtb004=$tb004;
		//	$tb005no1=$tb005;
			//$vta003=$ta003;  //日期
		//    $vtb013=$vtb013;
		//	echo $mvtc002.'test';
		//	sleep(5);
			
				//科目各期金額檔  actmd  
		$data1 = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'mb1001' => $vtb005, 
		         'mb1002' => $yymmdd,
				 'mb1003' => $tb005,
		         'mb1004' => $tb0071,
				 'mb1005' => $tb0072,
			     'mb1006' => $tb0071c,
				 'mb1007' => $tb0072c,
				 'mb1008' => $vtb013,
				 'mb1009' => $tb0151,
				 'mb1010' => $tb0152
				     
                );	
				
	//	   if ($tb005>='' and $vdail==0) {$this->db->insert('actmb', $data1);}
			
		   //不同單號合計歸0  到  1040616
		 
                 //上      本		   
		//   if ((($mvtb005<>$vtb005) and ($mvtb004<>$vtb004))  or  ($vdail==0))   {
			if ($mvtb005<>$vtb005 or  $vdail==0)   {
		//	if ($mvtb005<>$tb005no or  $vdail==0)   {
			   $this->db->insert('actmb1', $data1);		   
			   }	 
		   else  
			    {$this->db->where('a.mb1001', $mvtb005);   //vtb005 改
			    //     $this->db->where('a.mb1002', $yymmdd);
				   $this->db->update('actmb1 as a', $data1);}
				   
			
				   
				   
		  // if ( $mvtb005<>$vtb005)   {$tb0071=0;$tb0072=0;$tb0071c=0;$tb0072c=0;$tb0151=0;$tb0152=0;}
		  //合計不同單號
		   $vdail++;           //預設 0 
         //  	$vtb005=$tb005;  //科目代號
			$mvtb004=$tb004;  //借貸
		    $vtb013=$vtb013;
			
			$mvtb005=$tb005no;
		    $n++; 
		
    }
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
		$this->db->where('b.ma008','1' ); 
		$this->db->or_where('b.ma008','3' );
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