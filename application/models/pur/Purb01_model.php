<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purb01_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	
		
	//計算 	
	function batchaf()           
        {
		  $vtc001=$this->input->post('purq04a33');    //採購單別
	      $vtc003=substr($this->input->post('tb204c'),0,4).substr($this->input->post('tb204c'),5,2).substr(rtrim($this->input->post('tb204c')),8,2);
		  $sql = " SELECT tc001,tc003,MAX(tc002) as tc002  FROM purtc 
		  WHERE tc001 = '$vtc001'  AND tc003 = '$vtc003'   "; 
		  $query = $this->db->query($sql);
		  $i=0;
		  
		  foreach ($query->result() as $row)
            {  
			$mtc002[]=$row->tc002;                 //採購單號
			$i++;
            }
			IF ($mtc002[0] > '0'  ) {
			 $vtc002=$mtc002[0]; $num = (int)$vtc002 ; $vtc002 =  (string)$num; }
			ELSE {$vtc002=$vtc003.'000';}
					
		  // 滙率 幣別
		   $vtc005=$this->input->post('cmsq06a');
		   $sql = " SELECT mg001,mg003,MAX(mg002) as mg002  FROM cmsmg 
		  WHERE mg001 = '$vtc005'   "; 
		  $query = $this->db->query($sql);
		  $i=0;
		    if ($query->num_rows() > 0)  {
		  foreach ($query->result() as $row)
            {  
			$mtc006[]=$row->mg003;                 //匯率
			$i++;
            }
			}
			if ($mtc006[0] >'0' AND $mtc006[0] <= '999999' ) {$vtc006=$mtc006[0]; }
             ELSE {$vtc006=0;}	
		  
		  //廠商品號資料  $vtc002 採購單號, $vtc006 匯率 $vtc001 採購單別 $vtc003 採購日期
		  
	      $btb001=$this->input->post('tb001c');    
	      $etb001=$this->input->post('tb002c'); 
	      $btb002=$this->input->post('tb003c'); 
	      $etb002=$this->input->post('tb004c'); 
	
    $n=2;
    $totqty=0;
	$vtc0022=$vtc002;
	$vtc0021=$vtc002;    //現有採購單號, 若第一筆 加1
	$vtc002=$vtc002;
    $vtb010='';    //廠商
	$vdail=0;      //判斷是否第一筆
	$vtc026=0;     //稅率
	$mno='1000';
	$vno=1000;
		 $vtax=$this->session->userdata('sysma004');
    $sql="select tb039,tb001,tb002,tb003,tb004,ta010,tb013,tb016,tb026,tb024,tb014,tb032,tb019,tb015,tb017,ta006,ma055,ma015,ma014,ma044,ma026,ma025,tb010,tb004,tb005,tb006,tb007, tb009, tb018 
	  from `purtb` as a,`purma` as b,`purta` as c 
	  where  ta001=tb001 AND ta002=tb002 and tb010=ma001 AND tb039='N' AND tb001 >= '$btb001' AND tb001 <= '$etb001' AND tb002 >= '$btb002' AND tb002<='$etb002' AND tb010 !=''
	  order by  tb010,tb004 ";
	//$result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
   // while($row=mysql_fetch_assoc($result)){
	     $query = $this->db->query($sql) ;
		foreach ($query->result() as $row) {
        foreach($row as $i=>$v){
            $$i=$v;
        }
		
		  if ($vdail==0) {$vtb010=$tb010;  }
		    if ($tb026 =='1') {$vtc026=$vtax;}   //課稅別
		  if ($tb026 =='2') {$vtc026=$vtax;}
		  if ($tb026 >='3') {$vtc026=0;}
			if ($vtb010==$tb010 and  $vdail==0 ) {$num = (int)$vtc0021 + 1; $vtc0021 =  (string)$num;}			       
		 $data = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'tc001' => $this->input->post('purq04a33'), 
		         'tc002' => $vtc0021,
		         'tc003' => substr($this->input->post('tb204c'),0,4).substr($this->input->post('tb204c'),5,2).substr(rtrim($this->input->post('tb204c')),8,2),
		         'tc004' => $tb010,
		         'tc005' => $tb016,
				 'tc006' => $vtc006,
				 'tc007' => $ma026,
				 'tc008' => $ma025,
			     'tc009' => $ta006,
		         'tc010' => $ta010,
				 'tc011' => $tb013,
				 'tc012' => '1', 
				 'tc013' => 0, 
				 'tc014' => 'Y', 
				 'tc018' => $tb026,
				 'tc021' => $ma014,
				 'tc022' => $ma015,
				 'tc023' => $totqty,
				 'tc024' =>date("Ymd"),
				 'tc025' =>$this->session->userdata('manager'),
				 'tc026' => $vtc026,
				 'tc027' => $ma055,
			     'tc030' => '0'              
                );	
				if ($vtb010==$tb010 and  $vdail==0 ) {$this->db->insert('purtc', $data);$totqty=0;$n=0;$num = (int)$vtc002 + 1; $vtc002 =  (string)$num;$num = (int)$vtc0021 + 1; $vtc0021 =  (string)$num;
			       $mno='1000';$vno=1000;$vtb010=$tb010;  } 
				if ($vtb010!=$tb010 and $vdail >0 ) {$this->db->insert('purtc', $data);$totqty=0;$n=0;$num = (int)$vtc002 + 1; $vtc002 =  (string)$num;$num = (int)$vtc0021 + 1; $vtc0021 =  (string)$num;
				   $mno='1000';$vno=1000;$vtb010=$tb010;  } 
				//   echo var_dump($tb010);exit;
			
	 	    $totqty+=$tb009;
			$vtb010=$tb010;
		
			$vdail++;
			$vno = $vno + 10;
		
				//明細 PURTD
		$data1 = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'td001' => $this->input->post('purq04a33'), 
		         'td002' => $vtc002,
		         'td003' => (string)$vno,
		         'td004' => $tb004,
		         'td005' => $tb005,
				 'td006' => $tb006,
				 'td007' =>$this->input->post('cmsq03a'),
				 'td008' => $tb014,
			     'td009' => $tb015,
				 'td016' => 'N',
		         'td010' => $tb017,
				 'td011' => $tb018,
				 'td012' => $tb019,
				 'td014' => $tb024,
				 'td026' => $tb001,
				 'td027' => $tb002,
				 'td028' => $tb003,
				 'td018' => 'Y', 
				 'td025' => $tb032
				     
                );	
		   if ($tb004>='' and $tb039='N') {$this->db->insert('purtd', $data1);}
		   
		      //明細回寫 PURTB 請購單加採購單號
			 //  $existb = $this->purcopi08_model->selone3d($th014,$th015,$th016);
			     $vtb022=$vtc001.'-'.$vtc002.'-'.$vno;
			    if ($tb004>='' and $tb039='N' ) {
         $sql9 = " UPDATE purtb set tb022='$vtb022',tb021='Y',tb025='Y',tb039='Y' WHERE tb001 = '$tb001'  AND tb002 = '$tb002'  AND tb003 = '$tb003' "; 
		 $query = $this->db->query($sql9);	} 
			
		   
		   
		$n++; 
		
    }
     //單頭合計
	  $sql="SELECT tb001, tb002, sum(tb009) AS tb009, SUM( tb018 ) AS tb018 FROM  `purtb` AS a
	  where   tb001 >= '$btb001' AND tb001 <= '$etb001' AND tb002 >= '$btb002' AND tb002<='$etb002' AND tb010 !='' AND tb039='N'
	  group by tb001, tb001
	  order by  tb010 ";
	// $result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
   // while($row=mysql_fetch_assoc($result)){
	     $query = $this->db->query($sql) ;
		foreach ($query->result() as $row) {
        foreach($row as $i=>$v){
            $$i=$v;
        }
		   $vtb018=0;
		  if ($tb026 =='1') {$vtb018=$tb018;$vtb0181=round($tb018*0.05,0);}   //課稅別
		  if ($tb026 =='2') {$vtb018=$vtb018-round($tb018*0.05,0);$vtb0181=round($tb018*0.05,0);}
		  if ($tb026 >='3') {$vtb018=$tb018;$vtb0181=0;}
		  $num = (int)$vtc0022 + 1; $vtc0022 =  (string)$num;
		 $data2 = array(
			     'tc023' => $tb009,
		         'tc019' => $tb018,
				 'tc020' => $vtb0181      
                );	
		 $this->db->where('tc001', $this->input->post('purq04a33'));
		 $this->db->where('tc002', $vtc0022);
		 $this->db->update('purtc', $data2);
	    }  
		
		
		
		  return true;	 
	      
  }  
  ////單頭合計
	function batchbf()           
        {
		  $vtc001=$this->input->post('purq04a33');    
	      $vtc003=substr($this->input->post('tb204c'),0,4).substr($this->input->post('tb204c'),5,2).substr(rtrim($this->input->post('tb204c')),8,2);
		
		  
		  //廠商品號資料  $vtc002 採購單號, $vtc006 匯率 $vtc001 採購單別 $vtc003 採購日期
		  
	      $btb001=$this->input->post('tb001c');    
	      $etb001=$this->input->post('tb002c'); 
	      $btb002=$this->input->post('tb003c'); 
	      $etb002=$this->input->post('tb004c'); 
	
    $n=2;
    $totqty=0;
	$vtd001='';
	$vtd002='';
    $vtb010='';
	$vtax=0;
	$vdail=0;
	 $vtax=$this->session->userdata('sysma004');
   $sql="SELECT a.td001, a.td002,b.tc018,b.tc026, sum(a.td008) AS td008, SUM( a.td011 ) AS td011 FROM  `purtd` AS a , `purtc` AS b
	  where  tc001=td001 AND tc002=td002 AND  td026 >= '$btb001' AND td026 <= '$etb001' AND td027 >= '$btb002' AND td027<='$etb002' AND td016='N'
	  group by  td001, td002,tc018,tc026
	  order by  td001,td002 ";
	// $result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
    // while($row=mysql_fetch_assoc($result)){
		$query = $this->db->query($sql) ;
		foreach ($query->result() as $row) {
		 foreach($row as $i=>$v){
            $$i=$v;
        }
   	 
		   $vtd011=0;$vtb0181=0;  //稅額
		 
		  if ($tc018 =='1') {$vtd011=$td011;$vtb0181=round($td011*$vtax,0);}   //課稅別
		  if ($tc018 =='2') {$vtd011=$vtd011-round($td011*$vtax,0);$vtb0181=round($td011*$vtax,0);}
		  if ($tc018 >='3') {$vtd011=$td011;$vtb0181=0;}
		//  $num = (int)$vtc0022 + 1; $vtc0022 =  (string)$num;
		   $vtd001=$td001;$vtd002=$td002;
		 $data2 = array(
			     'tc023' => $td008,
		         'tc019' => $td011,
				 'tc020' => $vtb0181      
                );	
		 $this->db->where('tc001', $vtd001);
		 $this->db->where('tc002', $vtd002);
		 $this->db->update('purtc', $data2);
	    } 
		  return true;	
  }  
		
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>