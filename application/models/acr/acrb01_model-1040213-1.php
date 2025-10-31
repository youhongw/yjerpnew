<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class acrb01_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('tb001, tb002, tb003, tb004, tb005, tb006, create_date');
          $this->db->from('purtb');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('tb001 desc, tb002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();			
			
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('purtb');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//ajax 查詢主鍵 顯示用 品類代號  
	function ajaxkey($seg1)    
        {                   
	      $this->db->set('tb002', $this->uri->segment(4));
	      $this->db->where('tb002', $this->uri->segment(4));
	      $query = $this->db->get('purtb');
			
	      if ($query->num_rows() > 0) 
		  {
		   $res = $query->result();
		   foreach ($query->result() as $row)
           {
            $result=$row->tb002;
           }
		   return $result;   
		  }
	    }
		
	//查詢一筆 修改用   
	function selone()    
        { 
		  $this->db->select('purtb.*,a.mv002 as tb013disp, b.mf002 as tb016disp,c.ma002 as tb010disp,d.mc002 as tb008disp,e.ta013,e.ta003,f.mb039');	
	      $this->db->from('purtb');
		  $this->db->where('purtb.tb001', $this->uri->segment(4)); 
		  $this->db->where('purtb.tb002', $this->uri->segment(5));
		  $this->db->where('purtb.tb003', $this->uri->segment(6));
		  $this->db->join('purta as e', 'purtb.tb001 = e.ta001' and 'purtb.tb002 = e.ta002','left');
		  $this->db->join('cmsmkv4 as a', 'purtb.tb013 = a.mv001','left');
	      $this->db->join('cmsmf as b', 'purtb.tb016 = b.mf001','left');
		  $this->db->join('copma as c', 'purtb.tb010 = c.ma001','left');
		  $this->db->join('cmsmc as d', 'purtb.tb008 = d.mc001','left');
		  $this->db->join('invmb as f', 'purtb.tb004 = f.mb001','left');
	      $query = $this->db->get();			
	      if ($query->num_rows() > 0) 
		   {
		    $result = $query->result();
		    return $result;   
		  }
	    }		
	
		
	//計算 	
	function batchaf()           
        {
		  $vta001=$this->input->post('acrq01a61');    //結帳單別
	      $vta003=substr($this->input->post('ta003c'),0,4).substr($this->input->post('ta003c'),5,2).substr(rtrim($this->input->post('ta003c')),8,2);
		  $sql = " SELECT ta001,ta003,MAX(ta002) as ta002  FROM acrta 
		  WHERE ta001 = '$vta001'  AND ta003 = '$vta003'   "; 
		  $query = $this->db->query($sql);
		  $i=0;
		  
		  foreach ($query->result() as $row)
            {  
			$mta002[]=$row->ta002;                 //結帳單單號 $vta002
			$i++;
            }
			IF ($mta002[0] > '0'  ) {
			 $vta002=$mta002[0]; $num = (int)$vta002 ; $vta002 =  (string)$num; }
			ELSE {$vta002=$vta003.'000';}
			
		//	$this->firephp->log($vta002);		
		//	$this->firephp->log('testtest');
		//	echo $vta002;
		//	sleep(10);
		  // 滙率 幣別 $vta008  測試 echo sleep(10)
		   $vta008=$this->input->post('cmsq06a');    //幣別
		   $sql = " SELECT mg001,mg003,MAX(mg002) as mg002  FROM cmsmg 
		  WHERE mg001 = '$vta008'   "; 
		  $query = $this->db->query($sql);
		  $i=0;
		    if ($query->num_rows() > 0)  {
		  foreach ($query->result() as $row)
            {  
			$mta009[]=$row->mg003;                 //匯率 $vta009 預設1
			$i++;
            }
			}
			if ($mta009[0] >'0' AND $mta009[0] <= '999999' ) {$vta009=$mta009[0]; }
             ELSE {$vta009=1;}	
		  
		  //客戶 結帳日 銷貨資料
		  
	      $btg005=$this->input->post('copq01ac');    
	      $etg005=$this->input->post('copq01ao'); 
	    //  $btg003=$this->input->post('ta038c'); 
	    //  $etg003=$this->input->post('ta038o'); 
		  $btg003=substr($this->input->post('ta038c'),0,4).substr($this->input->post('ta038c'),5,2).substr(rtrim($this->input->post('ta038c')),8,2);
	      $etg003=substr($this->input->post('ta038o'),0,4).substr($this->input->post('ta038o'),5,2).substr(rtrim($this->input->post('ta038o')),8,2);
    $n=2;
    $totqty=0;
	$vtc0022=$vta002;
	$vtc0021=$vta002;
	$vtc002=$vta002;       //單號
    $vtb010='';           //客戶
	
	 $vtg013=0;  $vtg025=0;  $vtg045=0;  $vtg046=0;$vtg200=0;      //小計     
	      
	$vdail=0;             //第一次廻圈
	$mno='1000';
	$vno=1000;
	//echo $btg005.'test'.$etg005.'kkk';
	//		sleep(10);單別,單號,日期,客戶,部門,6業務,7客戶全名,10廠別,11幣別,12匯率,16發票聯數,17課稅別,21發票日,44稅率, 200未收,20備註,ma031付款條件, th018備註,th004品號
    //$sql="select tg001,tg002,tg003,tg004,tg005,tg006,tg007,tg008,tg010,tg011,tg012,tg016,tg017,tg021,tg044,tg013+tg025-tg052-tg053 as tg200,tg020,tg015,tg025,tg045,tg046,ma031,th003,th004,th007,th018, th013,th035,th036,th037,th038,th008
	//  from `coptg` as a,`copma` as b,`copth` as c 
	//  where   tg001=th001 AND tg002=th002 AND tg004=ma001  AND tg004 >= '$btg005' AND tg004 <= '$etg005' AND tg003 >= '$btg003' AND tg003<='$etg003' AND tg004 !=''
	//  order by  tg004,tg001,tg002,th003 ";
	  
	  $sql="select tg001,tg002,tg003,tg004,tg005,tg006,tg007,tg008,tg010,tg011,tg012,tg016,tg017,tg021,tg044,tg013+tg025-tg052-tg053 as tg200,tg020,tg013,tg025,tg045,tg046,tg031,ma031,tg033
	  from `coptg` as a,`copma` as b
	  where   tg004=ma001  AND tg004 >= '$btg005' AND tg004 <= '$etg005' AND tg003 >= '$btg003' AND tg003<='$etg003' AND tg004 !=''
	  order by  tg004,tg001,tg002 ";
	$result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
    while($row=mysql_fetch_assoc($result)){
        foreach($row as $i=>$v){
            $$i=$v;
        }
		   //合計不同單號
		  
		  if ($vdail==0) {$vtb010=$tg004;  }            //第一筆 客戶相等
			if ($vtb010==$tg004 and  $vdail==0 ) {$num = (int)$vtc0021 + 1; $vtc0021 =  (string)$num;}   //vtc0021 單號+1
		
		 $data = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'ta001' => $this->input->post('acrq01a61'), 
		         'ta002' => $vtc0021,
		         'ta003' => substr($this->input->post('ta003c'),0,4).substr($this->input->post('ta003c'),5,2).substr(rtrim($this->input->post('ta003c')),8,2),
		         'ta004' => $tg004,
		         'ta005' => $tg006,   //業務員
				 'ta006' => $tg010,  //廠別
				 'ta008' => $tg007,  //客戶全名
			     'ta009' => $tg011,  //幣別
		         'ta010' => $tg012,   //匯率
				 'ta011' => $tg016,    //發票聯數
				 'ta025' => 'Y',       //確認碼
				 'ta012' => $tg017,    //課稅別
				 'ta022' => $tg020,    //備註
				 'ta016' => $tg021,    //發票日期				
				 'ta038' =>date("Ymd"),    //單據日
				 'ta039' =>$this->session->userdata('manager'),     
				 'ta040' => $tg044,     //營業稅率
			     'ta048' => 'N',          //簽核狀態  
				 'ta029' => $vtg013,    
 				 'ta030' => $vtg025, 
				 'ta041' => $vtg045, 
				 'ta042' => $vtg046, 
				 'ta031' => $vtg200
                );	
				if ($vtb010==$tg004 and  $vdail==0 ) {$this->db->insert('acrta', $data);$totqty=0;$n=0;$num = (int)$vtc002 + 1; $vtc002 =  (string)$num;$num = (int)$vtc0021 + 1; $vtc0021 =  (string)$num;
			       $mno='1000';$vno=1000;$vtb010=$tg004;  } 
				if ($vtb010!=$tg004 and $vdail >0 ) {$this->db->insert('acrta', $data);$totqty=0;$n=0;$num = (int)$vtc002 + 1; $vtc002 =  (string)$num;$num = (int)$vtc0021 + 1; $vtc0021 =  (string)$num;
				   $mno='1000';$vno=1000;$vtb010=$tg004;  } 
				  
			  
	 	    $totqty+=$tg033;   
			$vtb010=$tg004;
			
			//echo $vtb010.'test';
			//sleep(10);
			
			$vdail++;           //預設 0  
			$vno = $vno + 10;   //預設1000
			
				//明細 acrtb  
		$data1 = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'tb001' => $this->input->post('acrq01a61'), 
		         'tb002' => $vtc002,
		         'tb003' => (string)$vno,
		         'tb004' => '1',
		         'tb005' => $tg001,
				 'tb006' => $tg002,
				 'tb012' => 'Y', 
				 'tb017' => $tg013,
			     'tb018' => $tg025,
		         'tb019' => $tg045,
				 'tb020' => $tg046
				     
                );	
		   if ($tg004>='') {$this->db->insert('acrtb', $data1);}
		   //合計不同單號
		 
			$vtg013=$vtg013+$tg013;
			$vtg025=$vtg025+$tg025;
			$vtg045=$vtg045+$tg045;
			$vtg046=$vtg046+$tg046;
			$vtg200=$vtg200+$tg200;
		   //不同單號合計歸0
		   if ($vtc002!=$vtc0021   ) {$vtg013=0;$vtg025=0;$vtg045=0;$vtg046=0;$vtg200=0;}
		  //   if ($vtb010!=$tg004) {$vtg013=0;$vtg025=0;$vtg045=0;$vtg046=0;$vtg200=0;}
		$n++; 
			
    }
     //單頭合計  客戶+課稅別
	/*  $sql="SELECT ta004, ta011, sum(tb015)+sum(tb016) AS tb015, SUM( tb017 )+ SUM( tb018 ) AS tb018 FROM  `acrta` AS a, `acptb` AS b
	  where ta001=tb001 and ta002=tb002 and  tg004 >= '$btg005' AND tg004 <= '$etg005' AND ta003 >= '$btg003' AND ta003<='$etg003' AND tg004 !=''
	  group by tg004, ta011
	  order by  tg004,ta011 ";
	$result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
    while($row=mysql_fetch_assoc($result)){
        foreach($row as $i=>$v){
            $$i=$v;
        }
		  if ($ta011 =='1') {$vtb018=$tb018;$vtb0181=round($tb018*0.05,0);}
		  if ($ta011 =='2') {$vtb018=$vtb018-round($tb018*0.05,0);$vtb0181=round($tb018*0.05,0);}
		  if ($ta011 >='3') {$vtb018=$tb018;$vtb0181=0;}
		  $num = (int)$vtc0022 + 1; $vtc0022 =  (string)$num;
		 $data2 = array(
			     'tc023' => $tb014,
		         'tc019' => $vtb018,
				 'tc020' => $vtb0181      
                );	
		 $this->db->where('ta001', $this->input->post('purq04a33'));
		 $this->db->where('ta002', $vtc0022);
		 $this->db->update('acrta', $data2);
	    } */
		
		  return true;	 
	      
  }  
		
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>